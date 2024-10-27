@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
    <script>
        sendAxiosRequest('get', `/api/posts?type=suggestion`, {})
            .then(response => {
                if (response.data.status) {
                    const feedContainer = document.querySelector('.suggestion');
                    const posts = response.data.data; // Array of posts

                    if (posts.length > 0) {
                        // Loop through each post and add to feed
                        posts.forEach(post => {
                            const user = post.user;
                            const userDetails = user.user_details || {};
                            const profileImage = userDetails.img_path || '../images/profile.jpg';
                            const userName = `${userDetails.fname || ''} ${userDetails.lname || ''}`.trim() ||
                                'Anonymous';
                            const likesCount = post.likes_count || 0;
                            const commentsCount = post.comments_count || 0;
                            const imagePath = post.path ? post.path : ''; // replace with your default image path


                            const postCard = `
                        <div class="card post-card">
                            <div class="post-header">
                                <div class="user-info">
                                    <img src="${profileImage}" alt="User Avatar">
                                    <div>
                                        <div class="user-name">${userName}</div>
                                        <div class="text-muted">2 months ago</div>
                                    </div>
                                </div>
                            </div>

                            <div class="post-content mt-2">
                                <p>${post.title}</p>
                                <p>${post.content}</p>
                                <img src="{{ asset('${imagePath}') }}" alt="User's Post Media">
                            </div>

                            <div class="post-actions">
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
                        </div>`;
                            feedContainer.insertAdjacentHTML('beforeend', postCard);
                        });
                    } else {
                        feedContainer.innerHTML = "<p>No suggestions available.</p>";
                    }
                } else {
                    document.querySelector('.suggestion').innerHTML = "<p>No community feed available.</p>";
                }
            })
            .catch(error => {
                console.error(error);
                document.querySelector('.suggestion').innerHTML = "<p>Failed to load community feed.</p>";
            });
    </script>

    <h3 class="mt-3">Ask For Suggestion</h3>
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
                        <h5 class="modal-title text-center" id="searchModalLabel">Posting in/ Ask For Suggestion</h5>
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

    <div class="suggestion">
    </div>
    {{-- <div class="card post-card">
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

        <div class="post-actions">
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
            <img src="../images/card2.jpg" alt="User's Post Media">
        </div>

        <div class="post-actions">
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
            <img src="../images/card1.avif" alt="User's Post Media">
        </div>

        <div class="post-actions">
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
            <img src="../images/card2.jpg" alt="User's Post Media">
        </div>

        <div class="post-actions">
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
    </div> --}}
    <script src="{{ asset('js/customjs/chatting.js') }}"></script>
@endsection
