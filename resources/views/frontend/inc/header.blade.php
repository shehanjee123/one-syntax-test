<nav class="navbar bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ Route('home') }}">
        <img src="{{ asset('assets/images/images.jpeg') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        <span class="text-sky-500 text-xl font-semibold font-sans">OneSyntax</span>
      </a>
      <a href="{{ Route('oldPost') }}" class="p-2 bg-cyan-950 text-cyan-500 font-semibold ease-in-out duration-300">Show Post</a>
      <a href="{{ Route('post.upload-form') }}" class="p-2 bg-cyan-950 text-cyan-500 font-semibold ease-in-out duration-300">Create a Post</a>
    </div>
  </nav>