@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

<style>
    .card-image {
        width: 350px;
        height: auto;
    }

    .card-img-right {
        width: 100%;
        height: auto;
        object-fit: fill;
        border: 2px solid #20948b;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .card {
            flex-direction: column;
        }

        .card-image {
            width: 100%;
            height: 200px;
        }
    }
</style>

@section('maincontent')
    <div class="container mt-5 card">
        <h3 class="text-center mt-3">Events History</h3>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs mt-3" id="profileTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" role="tab"
                    aria-controls="personal" aria-selected="true">
                    Schedule New Event
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="upcoming-events-tab" data-bs-toggle="tab" data-bs-target="#upcoming-events"
                    role="tab" aria-controls="upcoming-events" aria-selected="false">
                    Upcoming Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="past-events-tab" data-bs-toggle="tab" data-bs-target="#past-events" role="tab"
                    aria-controls="past-events" aria-selected="false">
                    Past Events
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Add New Event Tab -->
            <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <form id="eventDetails" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3">
                        <label for="event_mode"><span class="text-danger">*</span> Event Mode</label>
                        <select class="form-control" id="event_mode" name="event_mode">
                            <option value="">Select Event Mode</option>
                            <option value="Virtual">Virtual</option>
                            <option value="Physical">Physical</option>
                        </select>
                        <div id="eventModeErrorMsg" class="text-danger font-weight-bold"></div>
                    </div>
                    <div class="form-group mb-3" id="addressOrLinkField" style="display: none;">
                        <label id="addressOrLinkLabel" for="address_or_link"><span class="text-danger">*</span>
                            Address/Link</label>
                        <input type="text" class="form-control" id="address_or_link" name="address_or_link"
                            placeholder="">
                        <div id="address_or_linkErrorMsg" class="text-danger font-weight-bold"></div>
                    </div>

                    <div class="form-group my-3">
                        <label for="title"><span class="text-danger">*</span> Event Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter Event Title">
                        <div id="titleErrorMsg" class="text-danger font-weight-bold"></div>
                    </div>

                    <div class="form-group my-3">
                        <label for="description"><span class="text-danger">*</span> Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Event Description"></textarea>
                        <div id="descriptionErrorMsg" class="text-danger font-weight-bold"></div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="date"><span class="text-danger">*</span> Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div id="dateErrorMsg" class="text-danger font-weight-bold"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="start_time"><span class="text-danger">*</span> Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time">
                            </div>
                            <div id="start_timeErrorMsg" class="text-danger font-weight-bold"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="end_time"><span class="text-danger">*</span> End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time">
                            </div>
                            <div id="end_timeErrorMsg" class="text-danger font-weight-bold"></div>
                        </div>
                    </div>

                    <!-- Image Upload Field -->
                    <div class="form-group my-3">
                        <label for="event_image">Event Image</label>
                        <input type="file" class="form-control" id="event_image" name="event_image"
                            accept="image/*">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>
                </form>
            </div>

            <!-- Scheduled Events Tab -->
            <div class="tab-pane fade" id="upcoming-events" role="tabpanel" aria-labelledby="upcoming-events-tab">
                <div class="p-3">
                    <div class="card flex-row align-items-center row shadow-sm p-3">
                        <div class="card-body col-md-6">
                            <h5 class="card-title">Busting Maternal Myths</h5>
                            <p class="card-text"><strong>Event Mode:</strong> Virtual</p>
                            <p class="card-text"><strong>Description:</strong> Busting Maternal Myths</p>
                            <p class="text-muted"><i class="bi bi-calendar me-2"></i> Oct 15, 2024</p>
                            <p class="text-muted"><i class="bi bi-clock me-2"></i> 10:00 AM - 12:00 PM</p>
                        </div>
                        <div class="card-image col-md-6">
                            <a href="../images/event.jpeg" target="_blank">
                                <img src="../images/event.jpeg" class="card-img-right shadow" alt="Event Image">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-3">
                    <div class="card flex-row align-items-center row shadow-sm p-3">
                        <div class="card-body col-md-6">
                            <h5 class="card-title">Another Event Title</h5>
                            <p class="card-text"><strong>Event Mode:</strong> Physical</p>
                            <p class="card-text"><strong>Description:</strong> Another brief description for the next
                                event, keeping it concise.</p>
                            <p class="text-muted"><strong><i class="bi bi-calendar me-2"></i></strong> Oct 20, 2024</p>
                            <p class="text-muted"><strong><i class="bi bi-clock me-2"></i></strong> 3:00 PM - 5:00 PM</p>
                        </div>
                        <div class="card-image col-md-6">
                            <a href="../images/event1.jpg" target="_blank">
                                <img src="../images/event1.jpg" class="card-img-right shadow" alt="Event Image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Past Events Tab -->
            <div class="tab-pane fade" id="past-events" role="tabpanel" aria-labelledby="past-events-tab">
                <div class="p-3">
                    <div class="card flex-row align-items-center row shadow-sm p-3">
                        <div class="card-body col-md-6">
                            <h5 class="card-title">Busting Maternal Myths</h5>
                            <p class="card-text"><strong>Event Mode:</strong> Virtual</p>
                            <p class="card-text"><strong>Description:</strong> Busting Maternal Myths</p>
                            <p class="text-muted"><i class="bi bi-calendar me-2"></i> Oct 15, 2024</p>
                            <p class="text-muted"><i class="bi bi-clock me-2"></i> 10:00 AM - 12:00 PM</p>
                        </div>
                        <div class="card-image col-md-6">
                            <img src="../images/event.jpeg" class="card-img-right" alt="Event Image">
                        </div>
                    </div>
                </div>

                <div class="p-3">
                    <div class="card flex-row align-items-center row shadow-sm p-3">
                        <div class="card-body col-md-6">
                            <h5 class="card-title">Another Event Title</h5>
                            <p class="card-text"><strong>Event Mode:</strong> Physical</p>
                            <p class="card-text"><strong>Description:</strong> Another brief description for the next
                                event, keeping it concise.</p>
                            <p class="text-muted"><strong><i class="bi bi-calendar me-2"></i></strong> Oct 20, 2024</p>
                            <p class="text-muted"><strong><i class="bi bi-clock me-2"></i></strong> 3:00 PM - 5:00 PM</p>
                        </div>
                        <div class="card-image col-md-6">
                            <img src="../images/event1.jpg" class="card-img-right" alt="Event Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eventModeSelect = document.getElementById('event_mode');
            const addressOrLinkField = document.getElementById('addressOrLinkField');
            const addressOrLinkInput = document.getElementById('address_or_link');
            const addressOrLinkLabel = document.getElementById('addressOrLinkLabel');

            eventModeSelect.addEventListener('change', function() {
                if (this.value === 'Virtual') {
                    addressOrLinkField.style.display = 'block';
                    addressOrLinkLabel.textContent = 'Link';
                    addressOrLinkInput.placeholder = 'Enter link';
                } else if (this.value === 'Physical') {
                    addressOrLinkField.style.display = 'block';
                    addressOrLinkLabel.textContent = 'Address';
                    addressOrLinkInput.placeholder = 'Enter Address';
                } else {
                    addressOrLinkField.style.display = 'none';
                    addressOrLinkInput.placeholder = ''; // Clear placeholder
                }
            });
        });

        $(document).ready(function() {
            $(document).on('submit', '#eventDetails', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                sendAxiosRequest('post', '/api/events', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        if (response.data.status) {
                            alert(response.data.message);
                            location.reload();
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        let errorMsgs = error.response.data.errors;
                        for (const errorMsgKey in errorMsgs) {
                            if (errorMsgs.hasOwnProperty(errorMsgKey)) {
                                console.log(errorMsgKey, errorMsgs[errorMsgKey]);
                                $(`#${errorMsgKey}ErrorMsg`).html(errorMsgs[errorMsgKey].join(","));
                            }
                        }
                    });
            });
        });
    </script>
@endsection
