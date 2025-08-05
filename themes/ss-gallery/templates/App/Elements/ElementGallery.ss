<h2>$Title</h2>
<div id="jGallery" class="gallery">
    <% loop $OffsetGalleryImages(0, 6) %>

        <div class="image-container">
            <a href="#" data-carousel-id="carousel-item-$Pos" aria-label="Open image">

                <img src="$ResizedImage(50, 600).URL" alt="$Alt">
            </a>
        </div>

    <% end_loop %>
    <dialog id="dialog">

        <%--                <img src="$ResizedImage(100, 1200).URL" alt="$Alt">--%>
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <% loop $OffsetGalleryImages(0, 0) %>
                <div class="carousel-item carousel-item-$Pos <% if $Pos == 1 %>active<% end_if %>">
                    <img src="$ResizedImage(100, 1200).URL" class="d-block w-100" alt="$Alt">
                </div>
                <% end_loop %>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <button class="closeButton">X Close</button>
    </dialog>
</div>
<div>
    $LoadAllLink.Raw
</div>


