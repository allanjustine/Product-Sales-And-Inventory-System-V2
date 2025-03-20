<div>
    <h3 class="mt-3 text-center">About AJM Restaurant</h3>
    <hr>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="images/slide2.jpg" alt="AJM Restaurant" class="img-fluid mb-3">
            </div>
            <div class="col-md-6">
                <p class="lead">Welcome to AJM Restaurant, where we serve the most delicious and authentic cuisine in
                    town.</p>
                <p>Our restaurant was founded with a passion for good food and a desire to share our love of cuisine
                    with the world. We use only the freshest ingredients and traditional cooking methods to bring you
                    the very best in flavor and quality.</p>
                <p>At AJM Restaurant, we take pride in our warm and welcoming atmosphere, where you can relax and enjoy
                    a memorable dining experience with family and friends. Whether you're in the mood for a quick lunch
                    or a leisurely dinner, we have something to suit every taste and appetite.</p>
                <p>So come visit us today and discover why AJM Restaurant is the best place to eat in town!</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Welcome to AJM Restaurant, where we serve the most delicious and authentic cuisine in
                    town.</p>
                <p>Our restaurant was founded with a passion for good food and a desire to share our love of cuisine
                    with the world. We use only the freshest ingredients and traditional cooking methods to bring you
                    the very best in flavor and quality.</p>
                <p>At AJM Restaurant, we take pride in our warm and welcoming atmosphere, where you can relax and enjoy
                    a memorable dining experience with family and friends. Whether you're in the mood for a quick lunch
                    or a leisurely dinner, we have something to suit every taste and appetite.</p>
                <p>So come visit us today and discover why AJM Restaurant is the best place to eat in town!</p>
            </div>
            <div class="col-md-6">
                <img src="images/slide1.jpg" alt="AJM Restaurant" class="img-fluid mb-3">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="text-center">Testimonials</h2>
    </div>
    <div class="container my-2" style="overflow-x: auto;">
        <div class="d-flex gap-2 justify-content-center">
            @forelse ($testimonies as $testimony)
            <div class="col-sm-12 col-md-6 shadow-md my-2">
                <div class="row border justify-items-center align-items-center shadow-sm">
                    <div class="col-3">
                        <img src="images/profile.png" alt="image" class="img-fluid rounded-circle"
                            style="width: 130px; height: 130px;">
                    </div>
                    <div class="col-9">
                        <blockquote class="blockquote mb-0">
                            <p>"{{ $testimony->message }}"</p>
                            <footer class="blockquote-footer">{{ $testimony->name }}</footer>
                        </blockquote>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-5">
                <h6 class="text-center">
                    Drop your testimony and share your experience with us <a href="/feedbacks" wire:navigate
                        class="btn btn-link">Click Here</a>
                </h6>
            </div>
            @endforelse
        </div>
    </div>
</div>
