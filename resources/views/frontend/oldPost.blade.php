@extends('frontend.inc.app')
@section('title', env('APP_NAME').' | Home')

@section('css')

@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="flex justify-center mt-6 text-cyan-800 text-xl font-semibold font-mono mb-8">THis is Post Uploaded from websites</h3>
                </div>
                @foreach ($oldPosts as $oldPost )
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3">
                        <div class="relative p-6 bg-blue-200 border-2 border-sky-500">
                            <span class="block text-center text-gray-800 font-medium text-uppercase">Post ID : {{ $oldPost->id }}</span>
                            <span class="block text-center text-black-800 font-bold text-uppercase">{{ $oldPost->website->name }}</span>
                            <span class="block text-center text-gray-500 font-medium text-sm">{{ $oldPost->post_title }}</span>
                            <span class="block text-center text-gray-500 font-medium text-sm">{{ $oldPost->created_at->format('Y-m-d H:i:s') }}</span>
                            <div class="message-container" id="message-container"></div>
                            <form action="{{ route('sendMail') }}" method="post" class="sendMailForm">
                                @csrf
                                <input type="hidden" id="post_id" name="post_id" value="{{ $oldPost->id }}">
                                <button type="submit" id="sendMail" class="mt-2 bg-sky-700 px-14 py-1 text-white font-medium hover:bg-sky-900 ease-in-out duration-300 w-full">
                                    Send Mail
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection


@section('js')
<script>
    $(document).ready(function () {
        $(".sendMailForm").submit(function (event) {
            event.preventDefault();

            let form = $(this);
            let formData = form.serialize();
            let messageContainer = form.closest(".relative").find(".message-container");

            $.ajax({
                url: "{{ route('sendMail') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    form[0].reset();
                    messageContainer.html(`<div class="alert alert-success text-green-700 font-semibold p-2 mt-2">${response.message}</div>`);
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON?.message || "Something went wrong.";
                    messageContainer.html(`<div class="alert alert-danger text-red-700 font-semibold p-2 mt-2">${errorMessage}</div>`);
                }
            });
        });
    });
</script>
@endsection