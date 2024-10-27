$(document).ready(function () {
    // Enable rich text formatting for the contenteditable div
    $("#boldBtn").click(function () {
        document.execCommand("bold");
    });

    $("#italicBtn").click(function () {
        document.execCommand("italic");
    });

    $("#underlineBtn").click(function () {
        document.execCommand("underline");
    });

    $("#listBtn").click(function () {
        document.execCommand("insertUnorderedList");
    });

    // Trigger photo input when photo icon is clicked
    $("#photoIcon").click(function () {
        $("#photoInput").click();
    });

    // Trigger video input when video icon is clicked
    $("#videoIcon").click(function () {
        $("#videoInput").click();
    });

    // Handle file selection for photo
    $("#photoInput").change(function () {
        alert("Photo selected: " + this.files[0].name);
    });

    // Handle file selection for video
    $("#videoInput").change(function () {
        alert("Video selected: " + this.files[0].name);
    });

    // comment icon click event 
    $(".comment-icon").click(function () {
        var commentBox = $(this).closest(".post-actions").next(".comment-box");
        commentBox.toggle();
        commentBox.find(".reply-comment .mainarea").hide();
    });

    // Reply icon click event
    $(".reply-comment").click(function () {
        var commentBox = $(this).closest(".post-actions").next(".comment-box");
        commentBox.find(".reply-comment-box .mainarea").toggle();
        commentBox.find(".comment-box .mainarea").hide();
    });
});
