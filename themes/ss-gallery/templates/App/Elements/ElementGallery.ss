<h2>$Title</h2>
<div class="gallery">
    <% loop $GalleryImages %>

        <div class="image-container">
            <img
                style="
                display: block;
            max-height: 200px;
            height:100%;
            "
                    src="$ResizedImage(50, 400).URL"
                alt="$Alt"
            >
        </div>

    <% end_loop %>
</div>

<style>
    .gallery {
        max-width: 800px;
        display: flex;
        flex-wrap: wrap;
    }
    .image-container {

    }
</style>
