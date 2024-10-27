@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <h3 class="mt-2">Virtual Baby Shower</h3>
    <!-- Search Bar inside a Card -->
    <div class="card-custom">
        <input type="text" class="form-control search-field" placeholder="What's on your mind?" data-toggle="modal"
            data-target="#searchModal" readonly>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="postForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="searchModalLabel">Posting in/ Virtual Baby Shower</h5>
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
                                <i class="fas fa-image"></i>
                            </span>
                            <span class="upload-icon" title="Upload Video" id="videoIcon">
                                <i class="fas fa-video"></i>
                            </span>
                        </div>

                        <!-- Hidden file inputs for photo and video -->
                        <input type="file" id="photoInput" name="photo" accept="image/*" style="display: none;" />
                        <input type="file" id="videoInput" name="video" accept="video/*" style="display: none;" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Publish Post</button>
                    </div>
                </form>
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
            <img src="../images/card1.avif" alt="User's Post Media">
        </div>

        <div class="post-actions mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="icon me-4"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                <span class="icon comment-icon me-4"><i class="bi bi-chat-dots"></i> 0</span>
                <span class="icon"><i class="bi bi-share"></i></span>
            </div>

            <!-- Dropdown for post options -->
            <div class="dropdown">
                <button class="btn btn-link" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Bookmark Post</a></li>
                    <li><a class="dropdown-item" href="#">Report Post</a></li>
                </ul>
            </div>
        </div>

        <!-- Comment box with button and icons inside the textarea container -->
        <div class="comment-box mt-3" style="display: none; width: 100%;">
            <div class="mainarea" style="position: relative;">
                <textarea class="form-control" rows="6" placeholder="Add a comment..."
                    style="width: 100%; padding-bottom: 50px;"></textarea>
                <div class="comment-tools d-flex align-items-center"
                    style="position: absolute; bottom: 10px; left: 10px; right: 10px; display: flex; justify-content: space-between;">
                    <div class="d-flex">
                        <span class="icon-sticker me-4" style="cursor: pointer;">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="icon-gallery" style="cursor: pointer;">
                            <i class="fas fa-image"></i>
                        </span>
                    </div>
                    <button type="button" class="btn btn-primary ms-auto">Comment</button>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="reply-comment mt-4">
                <h5>Comments</h5>
                <div class="user-info">
                    <div class="profile">
                        <img src="../images/profile.jpg" alt="User Image" />
                        <span class="name">Anonymous _</span>
                    </div>
                    <span class="time">44 minutes ago</span>
                </div>

                <div class="post-content mt-2">
                    <p>Hello everyone!</p>
                    <p>Introducing Ekakshra Mahajan Mandhar to our Cloudnine Mamas Community.</p>
                </div>

                <div class="post-actions mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                        <span class="icon reply-comment"><i class="bi bi-reply"></i> 1</span>
                    </div>

                    <!-- Dropdown for post options -->
                    <div class="dropdown">
                        <button class="btn btn-link" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Bookmark Comment</a></li>
                            <li><a class="dropdown-item" href="#">Delete Comment</a></li>
                        </ul>
                    </div>
                </div>

                <div class="reply-comment-box">
                    <div class="mainarea" style="position: relative;">
                        <textarea class="form-control" rows="6" placeholder="Add a comment..."
                            style="width: 100%; padding-bottom: 50px;"></textarea>
                        <div class="comment-tools d-flex align-items-center"
                            style="position: absolute; bottom: 10px; left: 10px; right: 10px; display: flex; justify-content: space-between;">
                            <div class="d-flex">
                                <span class="icon-sticker me-4" style="cursor: pointer;">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="icon-gallery" style="cursor: pointer;">
                                    <i class="fas fa-image"></i>
                                </span>
                            </div>
                            <button type="button" class="btn btn-primary ms-auto">Comment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/customjs/chatting.js') }}"></script>
@endsection
