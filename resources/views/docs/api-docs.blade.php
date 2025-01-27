<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">API Documentation</h1>

        <div class="alert alert-info">
            <strong>Note:</strong> All API requests must include the following header:
            <pre><code>Accept: application/json</code></pre>
        </div>

        <div class="accordion" id="apiDocsAccordion">

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCars">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCars" aria-expanded="true" aria-controls="collapseCars">
                        GET /api/cars
                    </button>
                </h2>
                <div id="collapseCars" class="accordion-collapse collapse show" aria-labelledby="headingCars"
                    data-bs-parent="#apiDocsAccordion">
                    <div class="accordion-body">
                        <h5>GET /api/cars</h5>
                        <p>Retrieve a list of cars owned by the authenticated user.</p>
                        <h6>Response:</h6>
                        <pre><code>{
    "status": true,
    "message": "Cars fetched successfully!",
    "cars": [...]
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAddCar">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseAddCar" aria-expanded="false" aria-controls="collapseAddCar">
                        POST /api/cars/add
                    </button>
                </h2>
                <div id="collapseAddCar" class="accordion-collapse collapse" aria-labelledby="headingAddCar"
                    data-bs-parent="#apiDocsAccordion">
                    <div class="accordion-body">
                        <h5>POST /api/cars/add</h5>
                        <p>Add a new car to the authenticated user's collection.</p>
                        <h6>Request Body:</h6>
                        <pre><code>{
    "name": "required|string|max:255|min:3",
    "model": "required|string|max:255|min:3",
    "model_year": "required|integer|digits:4",
    "image": "required|image|mimes:jpeg,png,jpg,gif,svg|max:20420"  //max 20MB
}</code></pre>
                        <h6>Response:</h6>
                        <pre><code>{
    "status": true,
    "message": "Car added successfully!",
    "car": {...}
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingShowCar">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseShowCar" aria-expanded="false" aria-controls="collapseShowCar">
                        GET /api/cars/{id}
                    </button>
                </h2>
                <div id="collapseShowCar" class="accordion-collapse collapse" aria-labelledby="headingShowCar"
                    data-bs-parent="#apiDocsAccordion">
                    <div class="accordion-body">
                        <h5>GET /api/cars/{id}</h5>
                        <p>Retrieve details of a specific car owned by the authenticated user.</p>
                        <h6>Response:</h6>
                        <pre><code>{
    "status": true,
    "message": "Car fetched successfully!",
    "car": {...}
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingUpdateCar">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseUpdateCar" aria-expanded="false" aria-controls="collapseUpdateCar">
                        PUT /api/cars/{id}
                    </button>
                </h2>
                <div id="collapseUpdateCar" class="accordion-collapse collapse" aria-labelledby="headingUpdateCar"
                    data-bs-parent="#apiDocsAccordion">
                    <div class="accordion-body">
                        <h5>PUT /api/cars/{id}</h5>
                        <p>Update details of a specific car owned by the authenticated user.</p>
                        <h6>Request Body:</h6>
                        <pre><code>{
    "name": "required|string|max:255|min:3",
    "model": "required|string|max:255|min:3",
    "model_year": "required|integer|digits:4",
    "image": "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20420" //max 20MB
}</code></pre>
                        <h6>Response:</h6>
                        <pre><code>{
    "status": true,
    "message": "Car updated successfully!",
    "car": {...}
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingDeleteCar">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseDeleteCar" aria-expanded="false" aria-controls="collapseDeleteCar">
                        DELETE /api/cars/{id}
                    </button>
                </h2>
                <div id="collapseDeleteCar" class="accordion-collapse collapse" aria-labelledby="headingDeleteCar"
                    data-bs-parent="#apiDocsAccordion">
                    <div class="accordion-body">
                        <h5>DELETE /api/cars/{id}</h5>
                        <p>Delete a specific car owned by the authenticated user.</p>
                        <h6>Response:</h6>
                        <pre><code>{
    "status": true,
    "message": "Car deleted successfully!"
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingShowLicense">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseShowLicense" aria-expanded="false" aria-controls="collapseShowLicense">
                        GET /api/user/license
                    </button>
                </h2>
                <div id="collapseShowLicense" class="accordion-collapse collapse" aria-labelledby="headingShowLicense"
                    data-bs-parent="#apiDocsAccordion">
                    <div class="accordion-body">
                        <h5>GET /api/user/license</h5>
                        <p>Retrieve the user's uploaded license image URL.</p>
                        <h6>Response:</h6>
                        <pre><code>{
    "status": true,
    "message": "License image retrieved successfully!",
    "license_url": "..."
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingStoreLicense">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseStoreLicense" aria-expanded="false"
                        aria-controls="collapseStoreLicense">
                        POST /api/user/license
                    </button>
                </h2>
                <div id="collapseStoreLicense" class="accordion-collapse collapse"
                    aria-labelledby="headingStoreLicense" data-bs-parent="#apiDocsAccordion">
                    <div class="accordion-body">
                        <h5>POST /api/user/license</h5>
                        <p>Upload or replace the user's license image.</p>
                        <h6>Request Body:</h6>
                        <pre><code>{
    "image": "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20420"
}</code></pre>
                        <h6>Response:</h6>
                        <pre><code>{
    "status": true,
    "message": "License image stored successfully!",
    "license_url": "..."
}</code></pre>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
