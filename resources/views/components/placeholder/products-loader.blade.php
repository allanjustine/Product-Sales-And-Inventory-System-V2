<div style="overflow-x: hidden;">
    <div class="col-md-5 col-sm-6 offset-md-4 offset-sm-3 mt-4">
        <input type="search" class="form-control" placeholder="Search" disabled
            style="border-radius: 30px; height: 50px;">
    </div>
    <div class="row d-flex justify-content-center mt-5 pb-3">
        <div class="col-md-2 col-sm-3 col-6 text-center">
            <label for="category">Categories</label>
            <select name="category" id="select-cat" class="form-select" disabled>
                <option value="All">All</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-3 col-6 text-center">
            <label for="sort">Ratings</label>
            <select disabled class="form-select" id="select-cat">
                <option value="All">All</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-4 col-6 text-center">
            <label for="sort">Sort By</label>
            <select disabled class="form-select" id="select-cat">
                <option value="low_to_high">Price: Low to High</option>
                <option value="high_to_low">Price: High to Low</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-4 col-6 text-center">
            <label for="Clear Filters">Clear Filters</label>
            <button style="height: 40px;" disabled class="btn btn-secondary form-control"><i
                    class="fa-solid fa-broom-wide"></i> Clear Filters</button>
        </div>
    </div>

    <div class="container mt-5">
        <h3><i class="fa-light fa-box-open"></i> Products</h3>
        <div class="row">
            @for ($i = 0; $i < 8; $i++)
            <div class="col-md-3 mt-2 col-sm-4 col-6">
                <div class="card shadow product-card" style="min-width: 50px;">
                    <div style="position: relative;" class="placeholder-glow">
                        <span class="image-container placeholder" style="height: 150px; border-radius: 5px;">
                        </span>
                    </div>
                    <div class="card-footer text-center mb-3 mt-auto">
                        <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                            <span class="placeholder col-6"></span>
                        </h6>
                        <h5 class="font-size-1 font-weight-normal placeholder-glow text-capitalize">
                            <span class="placeholder col-8"></span>
                        </h5>
                        <div class="d-block font-size-1 placeholder-glow mb-2">
                            <span class="placeholder col-4"></span>
                        </div>
                        <div class="d-block font-size-1 placeholder-glow mb-2">
                            <span class="placeholder col-5"></span>
                        </div>
                        <button class="btn btn-primary mt-1 form-control placeholder disabled">
                            <i class="fa-solid fa-cart-shopping"></i> Buy Now
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
