@push('style')
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
@endpush
<div class="relative p-4 w-full max-w-2xl max-h-full">
  <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Post</h3>
  </div>

  <form action="/dashboard/{{ $post->slug }}" method="POST" id="post-form">
    @csrf
    @method('PATCH')
    <div class="mb-4">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
      <input type="text" name="title" id="title"
        class="@error('title') bg-red-50 border-red-500 text-red-900 focus:ring-red-600 focus:border-red-600 placeholder-red-900 @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Type post title" autofocus value="{{ old('title') ?? $post->title }}">
      @error('title')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
          {{ $message }}
        </p>
      @enderror
    </div>
    <div class="mb-4">
      <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
      <select id="category" name="category"
        class="@error('category') bg-red-50 border-red-500 text-red-900 focus:ring-red-600 focus:border-red-600 placeholder-red-900 @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected="" value="">Select category</option>
        @foreach (App\Models\Category::get() as $category)
          <option value="{{ $category->id }}" @selected((old('category') ?? $post->category->id) == $category->id)>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      @error('category')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
          {{ $message }}
        </p>
      @enderror
    </div>
    <div class="sm:col-span-2 mb-4"><label for="description"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
      <textarea id="description" name="body" rows="4"
        class="hidden @error('body') bg-red-50 border-red-500 text-red-900 focus:ring-red-600 focus:border-red-600 placeholder-red-900 @enderror block p-2.5 w-full text-sm text-gray-900  rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Write product description here">{{ old('body') ?? $post->body }}</textarea>
      @error('body')
        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
          {{ $message }}
        </p>
      @enderror
      <div id="editor">{!! old('body') ?? $post->body !!}</div>
    </div>
    <button type="submit"
      class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
      <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
          clip-rule="evenodd" />
      </svg>
      Update post
    </button>
  </form>
</div>

@push('script')
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  <script>
    const quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: 'Write post body here'
    });

    const quillEditor = document.querySelector('#editor');
    const description = document.querySelector('#description');
    const postForm = document.querySelector('#post-form');

    postForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const content = quillEditor.children[0].innerHTML;

      // console.log(content);
      description.value = content;

      this.submit();
    });
  </script>
@endpush
