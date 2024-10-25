@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <h3 class="mt-3">Overview</h3>
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
                        <button type="button" id="underlineBtn" title="Underline"><i class="fas fa-underline"></i></button>
                        <button type="button" id="listBtn" title="Bullet Points"><i class="fas fa-list-ul"></i></button>
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

                <div class="post-actions mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                        <span class="icon comment-icon me-5">
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
                    <div class="reply-comment">
                        <h2>Comments</h2>
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

                        <div class="post-actions mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                                <span class="icon comment-icon"><i class="bi bi-reply"></i> 1</span>
                            </div>

                            <!-- Dropdown for post options -->
                            <div class="dropdown">
                                <button class="btn btn-link" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Bookmark Comment</a>
                                    <a class="dropdown-item" href="#">Report Comment</a>
                                </div>
                            </div>
                        </div>
                    </div>
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

                <div class="post-actions mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                        <span class="icon comment-icon me-5">
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

                <div class="post-actions mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                        <span class="icon comment-icon me-5">
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

                <div class="post-actions mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                        <span class="icon comment-icon me-5">
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
    </div>
@endsection
