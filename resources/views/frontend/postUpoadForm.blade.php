@extends('frontend.inc.app')
@section('title', env('APP_NAME').' | Home')

@section('css')
   
@endsection

@section('content')
    <section class="userLigin-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="message-container"></div>
                    <form action="{{ Route('post.upload') }}" method="post" name="website-post" id="website-post">
                        @csrf
                        <div class="form-outer m-24 mb-44">
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" id="website_id">
                                    <option selected disabled>Select Website You Want to upload a post</option>
                                        @foreach ($websites as $website)
                                            <option value="{{ $website->id }}">{{ $website->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="post_title" name="post_title" placeholder="title">
                            </div>
                            <div class="mb-3">
                                <label for="post_description" class="form-label">Description</label>
                                <textarea class="form-control" id="post_description" name="post_description" rows="3"></textarea>
                            </div>
                            <input type="hidden" class="form-control" id="is_publish" name="is_publish" value="1">
                            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit">
                            <div id="login-message" class="mt-2 text-danger"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#website-post").submit(function (event) {
                event.preventDefault();

                let postDescription = $("#post_description").val();

                let formData = {
                    post_title: $("#post_title").val(),
                    website_id: $("#website_id").val(),
                    post_description: $("#post_description").val(),
                    is_publish: $("#is_publish").val(),
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('post.upload') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        $("#website-post")[0].reset();
                        $("#message-container").html(`<div class="alert alert-success">${response.message}</div>`);
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = errors ? Object.values(errors).join('<br>') : "Something went wrong.";
                        $("#message-container").html(`<div class="alert alert-danger">${errorMessage}</div>`);
                    }
                });
            });
        });
    </script>
@endsection
