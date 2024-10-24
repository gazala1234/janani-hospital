@extends('navbar')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <section class="row">
        <div class="col-12 col-lg-9">
            <!-- Search Bar inside a Card -->
            <div class="card-custom">
                <input type="text" class="form-control search-field" placeholder="What's on your mind?" data-toggle="modal"
                    data-target="#searchModal" readonly>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">Posting in/ Community Feed</h5>
                            <button type="button" class="close ms-auto" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <!-- Toolbar for text formatting -->
                            <div class="toolbar">
                                <button type="button" id="boldBtn" title="Bold"><i class="fas fa-bold"></i></button>
                                <button type="button" id="italicBtn" title="Italic"><i class="fas fa-italic"></i></button>
                                <button type="button" id="underlineBtn" title="Underline"><i
                                        class="fas fa-underline"></i></button>
                                <button type="button" id="listBtn" title="Bullet Points"><i
                                        class="fas fa-list-ul"></i></button>
                            </div>

                            <!-- Textarea for post content -->
                            <div contenteditable="true" class="form-control mb-3" placeholder="Write here" id="postContent"
                                style="height: 200px;"></div>

                            <!-- Icons for uploading photo and video -->
                            <div class="d-flex justify-content-around">
                                <span class="upload-icon" title="Upload Photo" id="photoIcon">
                                    <i class="fas fa-camera"></i>
                                </span>
                                <span class="upload-icon" title="Upload Video" id="videoIcon">
                                    <i class="fas fa-video"></i>
                                </span>
                            </div>

                            <!-- Hidden file inputs for photo and video -->
                            <input type="file" id="photoInput" accept="image/*" style="display: none;" />
                            <input type="file" id="videoInput" accept="video/*" style="display: none;" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Publish Post</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="community-feed">
                <div class="sort-by">
                    <h3>Community Feed</h3>
                    <span class="sort">Sort by :</span>
                    <select class="sort-options">
                        <option>Latest</option>
                        <option>Top</option>
                        <option>Trending</option>
                    </select>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="user-info">
                            <div class="profile">
                                <img src="../images/profile.jpg" alt="User Image" />
                                <span class="name">Anonymous _</span>
                            </div>
                            <span class="time">44 minutes ago</span>
                        </div>

                        <p class="user-question">
                            Hello Doctor, I am 17 weeks pregnant. I got my quadruple marker done as suggested by doctor.
                            The AFP MOM value is 3.1 and NTD screening shows positive. Should I be concerned? Please suggest
                            further course. Thanks
                        </p>

                        <div class="interaction">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <i class="bi bi-chat-dots"></i>
                            <i class="bi bi-share"></i>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="user-info">
                            <div class="profile">
                                <img src="../images/profile.jpg" alt="User Image" />
                                <span class="name">Anonymous _</span>
                            </div>
                            <span class="time">44 minutes ago</span>
                        </div>

                        <p class="user-question">
                            Hello Doctor, I am 17 weeks pregnant. I got my quadruple marker done as suggested by doctor.
                            The AFP MOM value is 3.1 and NTD screening shows positive. Should I be concerned? Please suggest
                            further course. Thanks
                        </p>

                        <div class="interaction">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <i class="bi bi-chat-dots"></i>
                            <i class="bi bi-share"></i>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="user-info">
                            <div class="profile">
                                <img src="../images/profile.jpg" alt="User Image" />
                                <span class="name">Anonymous _</span>
                            </div>
                            <span class="time">44 minutes ago</span>
                        </div>

                        <p class="user-question">
                            Hello Doctor, I am 17 weeks pregnant. I got my quadruple marker done as suggested by doctor.
                            The AFP MOM value is 3.1 and NTD screening shows positive. Should I be concerned? Please suggest
                            further course. Thanks
                        </p>

                        <div class="interaction">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <i class="bi bi-chat-dots"></i>
                            <i class="bi bi-share"></i>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="user-info">
                            <div class="profile">
                                <img src="../images/profile.jpg" alt="User Image" />
                                <span class="name">Anonymous _</span>
                            </div>
                            <span class="time">44 minutes ago</span>
                        </div>

                        <p class="user-question">
                            Hello Doctor, I am 17 weeks pregnant. I got my quadruple marker done as suggested by doctor.
                            The AFP MOM value is 3.1 and NTD screening shows positive. Should I be concerned? Please suggest
                            further course. Thanks
                        </p>

                        <div class="interaction">
                            <i class="bi bi-hand-thumbs-up"></i>
                            <i class="bi bi-chat-dots"></i>
                            <i class="bi bi-share"></i>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">John Duck</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Recent Messages</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('../assets/compiled/jpg/4.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Hank Schrader</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('../assets/compiled/jpg/5.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Dean Winchester</h5>
                            <h6 class="text-muted mb-0">@imdean</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('../assets/compiled/jpg/1.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">John Dodol</h5>
                            <h6 class="text-muted mb-0">@dodoljohn</h6>
                        </div>
                    </div>
                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Start
                            Conversation</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Use full version -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Updated Font Awesome CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script src="{{ asset('js/customjs/chatting.js') }}"></script>
@endsection
