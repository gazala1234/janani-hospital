@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <div class="add-service-container mt-5">
        <button class="btn-add-service" data-modal-target="modal3">Add Service</button>
    </div>

    {{-- Modal for adding services, opening from the right --}}
    <div class="modal-right" id="modal3">
        <div class="modal-content-right">
            <div class="modal-header">
                <span class="modal-close">&times;</span>
                <h1>Add New Service</h1>
            </div>
            
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group image-upload">
                    <label for="service-image">Upload Image:</label>
                    <input type="file" name="service_image" id="service-image" class="form-control" required>
                </div>
                
                <div class="form-group two-columns">
                    <div>
                        <label for="service-name">Service Name:</label>
                        <input type="text" name="service_name" id="service-name" class="form-control" required>
                    </div>
                    <div>
                        <label for="service-price">Service Price:</label>
                        <input type="number" name="service_price" id="service-price" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="service-description">Service Description:</label>
                    <textarea name="service_description" id="service-description" class="form-control" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary btn-submit my-3">Create Service</button>
            </form>
        </div>        
    </div>


    <section>
        <div class="row">
            <div class="column">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-hammer"></i>
                    </div>
                    <h3 class="service-heading">Service Heading</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
                        consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-brush"></i>
                    </div>
                    <h3 class="service-heading">Service Heading</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
                        consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <h3 class="service-heading">Service Heading</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
                        consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-truck-pickup"></i>
                    </div>
                    <h3 class="service-heading">Service Heading</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
                        consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="service-heading">Service Heading</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
                        consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-plug"></i>
                    </div>
                    <h3 class="service-heading">Service Heading</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
                        consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-script')
    <script>
        document.querySelectorAll("[data-modal-target]").forEach(button => {
            button.addEventListener("click", event => toggleModal(event.target.getAttribute("data-modal-target")));
        });

        document.querySelectorAll(".modal-close").forEach(button => {
            button.addEventListener("click", event => toggleModal(event.target.closest(".modal-right").id));
        });

        document.querySelectorAll(".modal-right").forEach(modal => {
            modal.addEventListener("click", event => {
                if (event.target === modal) toggleModal(modal.id);
            });
        });

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            const isVisible = getComputedStyle(modal).display === "flex";

            if (isVisible) {
                modal.classList.add("modal-hide-right");
                setTimeout(() => {
                    modal.classList.remove("modal-show-right", "modal-hide-right");
                    modal.style.display = "none";
                    document.body.style.overflow = "initial";
                }, 200);
            } else {
                modal.style.display = "flex";
                modal.classList.add("modal-show-right");
                document.body.style.overflow = "hidden";
            }
        }
    </script>
@endsection
