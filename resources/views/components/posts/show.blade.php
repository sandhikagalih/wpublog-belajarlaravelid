<main class="pt-4 pb-16 lg:pt-8 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
  <div class="flex justify-between px-4 mx-auto max-w-screen-xl">

    <article class="mx-auto w-full format format-xl sm:format-base lg:format-lg format-blue dark:format-invert">
      <header class="mb-4 lg:mb-6 not-format">
        <a href="/dashboard" class="font-medium text-sm text-blue-500 hover:underline">
          &laquo; Back to my posts
        </a>
        <address class="flex items-center my-6 not-italic">
          <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
            <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
              alt="{{ $post->author->name }}">
            <div>
              <a href="/authors/{{ $post->author->username }}" rel="author"
                class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->author->name }}</a>
              <p class="text-base text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
              <a href="/categories/{{ $post->category->slug }}" class="block">
                <span
                  class="bg-{{ $post->category->color }}-200 text-primary-900 text-xs font-medium inline-flex items-center px-2 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                  {{ $post->category->name }}
                </span>
              </a>

            </div>
          </div>
        </address>

        <div class="flex justify-start items-center gap-3">
          <div class="flex items-center space-x-3 sm:space-x-4">
            <a href="/dashboard/{{ $post->slug }}/edit"
              class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                <path fill-rule="evenodd"
                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                  clip-rule="evenodd" />
              </svg>
              Edit
            </a>
          </div>
          <button type="button"
            class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
            <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                clip-rule="evenodd" />
            </svg>
            Delete
          </button>
        </div>

        <h1 class="my-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
          {{ $post->title }}</h1>
      </header>
      <p>{!! $post->body !!}</p>

    </article>
  </div>
</main>
