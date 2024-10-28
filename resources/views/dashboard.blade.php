@extends('layouts.main')

<link href="{{ asset('css/customfiles/chatting.css') }}" rel="stylesheet">

@section('maincontent')
<script>
    sendAxiosRequest('get', `/api/posts?type=community_feed`, {})
        .then(response => {
            if (response.data.status) {
                const feedContainer = document.querySelector('.community-feed');
                const posts = response.data.data; // Array of posts

                if (posts.length > 0) {
                    // Loop through each post and add to feed
                    posts.forEach(post => {
                        const user = post.user;
                        const userDetails = user.user_details || {};
                        const profileImage = userDetails.img_path || '../images/profile.jpg';
                        const userName = `${userDetails.fname || ''} ${userDetails.lname || ''}`.trim() || 'Anonymous';
                        let likesCount = post.likes_count || 0;
                        let commentsCount = post.comments_count || 0;

                        // Begin constructing the HTML for the post card
                        let postCard = `
                        <div class="card" data-post-id="${post.id}">
                            <div class="card-content">
                                <div class="user-info">
                                    <div class="profile">
                                        <img src="${profileImage}" alt="User Image" />
                                        <span class="name">${userName}</span>
                                    </div>
                                    <span class="time">44 minutes ago</span>
                                </div>

                                <p class="user-question">
                                   ${post.content}
                                </p>

                                <div class="post-actions mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="icon me-4 like-icon" style="cursor: pointer;">
                                            <i class="bi bi-hand-thumbs-up"></i>
                                            <span class="like-count">${likesCount}</span>
                                        </span>
                                        <span class="icon comment-icon me-4" style="cursor: pointer;">
                                            <i class="bi bi-chat-dots"></i>
                                            <span class="comment-count">${commentsCount}</span>
                                        </span>
                                        <span class="icon"><i class="bi bi-share"></i></span>
                                    </div>
                                </div>`;

                        // Construct comments HTML
                        let commentsHTML = '';
                        if (post.comments && post.comments.length > 0) {
                            post.comments.forEach(comment => {
                                const commentUser = comment.user || {};
                                const commentUserDetails = commentUser.user_details || {};
                                const commentUserName =
                                    `${commentUserDetails.fname || ''} ${commentUserDetails.lname || ''}`.trim() || 'Anonymous';
                                const commentProfileImage = commentUserDetails.img_path || '../images/profile.jpg';
                                const commentLikesCount = comment.likes_count || 0;
                                let commentsCommentCount = comment.comments_count || 0;

                                commentsHTML += `
                                <div class="reply-comment mt-4">
                                    <div class="user-info">
                                        <div class="profile">
                                            <img src="${commentProfileImage}" alt="User Image" />
                                            <span class="name">${commentUserName}</span>
                                        </div>
                                        <span class="time">44 minutes ago</span>
                                    </div>
                                    <p class="user-question">${comment.content}</p>
                                    <div class="post-actions mt-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i>${commentLikesCount}</span>
                                            <span class="icon reply-comment"><i class="bi bi-reply"></i>${commentsCommentCount}</span>
                                        </div>
                                    </div>
                                </div>`;
                            });
                        } else {
                            commentsHTML = '<p>No comments available</p>';
                        }

                        postCard += `
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
                            </div>
                            <div class="reply-comments-section mt-4" style="display: none;">
                                <h5>${commentsCount === 0 ? 'No comments' : 'Comments'}</h5>
                                ${commentsHTML}
                            </div>
                        </div>
                    </div>`;

                        feedContainer.insertAdjacentHTML('beforeend', postCard);
                    });

                    // Like icon event listener
                    document.querySelectorAll('.like-icon').forEach(icon => {
                        icon.addEventListener('click', function() {
                            const postCard = this.closest('.card');
                            const id = postCard.getAttribute('data-post-id');
                            const likeCountSpan = this.querySelector('.like-count');
                            let currentLikes = parseInt(likeCountSpan.innerText);

                            // Toggle like
                            sendAxiosRequest('put', `/api/posts/${id}/like`,{})
                                .then(response => {
                                    if (response.data.status) {
                                        likeCountSpan.innerText = ++currentLikes;
                                        this.classList.add('liked'); // Add CSS for green color
                                    }
                                })
                                .catch(error => console.error(error));
                        });
                    });

                    // Comment icon toggle comment section
                    document.querySelectorAll('.comment-icon').forEach(icon => {
                        icon.addEventListener('click', function() {
                            const postCard = this.closest('.card-content');
                            const commentBox = postCard.querySelector('.comment-box');
                            const commentsSection = postCard.querySelector('.reply-comments-section');
                            commentBox.style.display = commentBox.style.display == 'none' ? 'block' : 'none';
                            commentsSection.style.display = commentsSection.style.display == 'none' ? 'block' : 'none';
                        });
                    });
                } else {
                    feedContainer.innerHTML = "<p>No community feed available.</p>";
                }
            } else {
                document.querySelector('.community-feed').innerHTML = "<p>No community feed available.</p>";
            }
        })
        .catch(error => {
            console.error(error);
            document.querySelector('.community-feed').innerHTML = "<p>Failed to load community feed.</p>";
        });
</script>




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

        {{-- <div class="card">
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

                        <p class="user-question">
                            Hello Doctor, I am 17 weeks pregnant. I got my quadruple marker done as suggested by doctor.
                            The AFP MOM value is 3.1 and NTD screening shows positive. Should I be concerned? Please suggest
                            further course. Thanks
                        </p>

                        <div class="post-actions mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="icon me-5"><i class="bi bi-hand-thumbs-up"></i> 2</span>
                                <span class="icon reply-comment"><i class="bi bi-reply"></i> 1</span>
                            </div>

                            <!-- Dropdown for post options -->
                            <div class="dropdown">
                                <button class="btn btn-link" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
        </div> --}}

    </div>
@endsection
