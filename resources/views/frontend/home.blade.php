@extends('frontend.inc.app')
@section('title', env('APP_NAME').' | Home')

@section('css')

@endsection

@section('content')
    <section class="section-outer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="flex justify-center mt-6 text-cyan-800 text-xl font-semibold font-mono mb-8">You can Follow this websites to the get the new News</h3>
                </div>
                {{-- This is Websites register in this system using the seeder ( WebsiteSeeder ) --}}
                @foreach ( $websites as $website)
                    <div class="col-12 col-sm-6 col-lg-4 mt-4">
                        <div class="card-outer relative p-20 bg-blue-200 border-2 border-sky-500">
                            <span class="website-name block text-center text-black-800 font-bold text-uppercase">{{ $website->name }}</span>
                            <span class="website-name block text-center text-black-500 font-semibold text-lowercase">{{ $website->url }}</span>
                            <span class="website-category block text-center text-gray-500 font-medium text-sm">{{ $website->category }}</span>
                            <form action="{{ route('subscription.make') }}" method="POST" class="subscribe">
                                @csrf
                                <input type="hidden" name="website_id" id="website_id" value="{{ $website->id }}">
                                <input type="email" name="email" id="email" class="mb-2 mt-2 w-full text-center outline-0 text-lowercase" placeholder="Your Mail Address" required>
                                <button type="submit" class="subcription-btn mt-2 bg-red-600 px-14 py-1 text-white font-medium hover:bg-red-800 ease-in-out duration-300 w-full">
                                    Subscribe
                                </button>
                            </form>
                            <!-- Message container for each form -->
                            <div class="message-container"></div>
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
        $(".subscribe").submit(function (event) {
            event.preventDefault();

            let form = $(this);
            let messageContainer = form.closest('.card-outer').find('.message-container');

            let formData = {
                website_id: form.find("input[name='website_id']").val(),
                email: form.find("input[name='email']").val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('subscription.make') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    form[0].reset();
                    messageContainer.html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message}
                        </div>
                    `);

                    // Auto remove the message after 1 second
                    setTimeout(function () {
                        messageContainer.fadeOut('slow', function () {
                            $(this).html('').show();
                        });
                    }, 1000);
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = errors ? Object.values(errors).join('<br>') : "Something went wrong.";
                    messageContainer.html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${errorMessage}
                        </div>
                    `);
                    // Auto remove the message after 1 second
                    setTimeout(function () {
                        messageContainer.fadeOut('slow', function () {
                            $(this).html('').show();
                        });
                    }, 1000);
                }
            });
        });
    });
</script>
@endsection

