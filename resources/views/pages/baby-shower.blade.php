@extends('navbar')

@section('page-heading')
    Virtual Baby Shower
@endsection

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')

    <body>
        <div class="row">
            <div class="col-12 col-lg-9">
                <h2>Virtual Baby Shower</h2>
                <!-- Search Bar inside a Card -->
                <div class="card-custom">
                    <input type="text" class="form-control search-field" placeholder="What's on your mind?"
                        data-toggle="modal" data-target="#searchModal" readonly>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="searchModalLabel">Posting in/ Virtual Baby Shower
                                </h5>
                                <button type="button" class="close ms-auto" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Toolbar for text formatting -->
                                <div class="toolbar">
                                    <button type="button" id="boldBtn" title="Bold"><i
                                            class="fas fa-bold"></i></button>
                                    <button type="button" id="italicBtn" title="Italic"><i
                                            class="fas fa-italic"></i></button>
                                    <button type="button" id="underlineBtn" title="Underline"><i
                                            class="fas fa-underline"></i></button>
                                    <button type="button" id="listBtn" title="Bullet Points"><i
                                            class="fas fa-list-ul"></i></button>
                                </div>

                                <!-- Textarea for post content -->
                                <div contenteditable="true" class="form-control mb-3" placeholder="Write here"
                                    id="postContent" style="height: 200px;"></div>

                                <!-- Icons for uploading photo and video -->
                                <div class="d-flex justify-content-around">
                                    <span class="upload-icon" title="Upload Photo" id="photoIcon">
                                        <i class="fas fa-image"></i>
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

                <div class="card post-card">
                    <div class="post-header">
                        <div class="user-info">
                            <img src="../images/profile.jpg" alt="User Avatar">
                            <div>
                                <div class="user-name">Janani Mamas</div>
                                <div class="text-muted">2 months ago</div>
                            </div>
                        </div>
                    </div>

                    <div class="post-content mt-2">
                        <p>Hello everyone!</p>
                        <p>Introducing Ekakshra Mahajan Mandhar to our Cloudnine Mamas Community.</p>
                        <!-- Photo/Video of the post -->
                        <img src="https://via.placeholder.com/600x400" alt="User's Post Media">
                    </div>

                    <div class="post-actions">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                            <span class="icon comment-icon me-5" id="commentIcon">
                                <i class="bi bi-chat-dots"></i> 0
                            </span>
                            <span class="icon"><i class="bi bi-share"></i></span>
                        </div>

                        <!-- Dropdown for post options -->
                        <div class="dropdown">
                            <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Bookmark Comment</a>
                                <a class="dropdown-item" href="#">Report Comment</a>
                            </div>
                        </div>
                    </div>

                    <!-- Comment box, initially hidden and placed below the icons -->
                    <div class="comment-box mt-3 position-relative" style="display: none; width: 100%;">
                        <textarea class="form-control" rows="6" placeholder="Add a comment..."
                            style="width: 100%; padding-right: 60px;"></textarea>

                        <!-- Icons and button positioned inside the comment box -->
                        <div class="comment-tools d-flex align-items-center"
                            style="position: absolute; bottom: 10px; left: 10px; right: 10px; display: flex; justify-content: space-between;">
                            <!-- Left side: Plus and Gallery icons -->
                            <div class="d-flex">
                                <span class="icon-sticker me-4" style="cursor: pointer;">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="icon-gallery" style="cursor: pointer;">
                                    <i class="fas fa-image"></i>
                                </span>
                            </div>
                            <!-- Right side: Comment button -->
                            <button class="btn btn-primary">Comment</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('../assets/compiled/jpeg/guest.jpeg') }}" alt="Face 1">
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
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Use full version -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Updated Font Awesome CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

        <script src="{{ asset('js/customjs/chatting.js') }}"></script>
    </body>

    </html>
@endsection
