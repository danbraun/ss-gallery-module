document.addEventListener('DOMContentLoaded', function () {
    const jGallery = document.getElementById('jGallery');
    if (!jGallery) return;

    const allCarouselItems = document.querySelectorAll('.gallery .carousel-item');
    const links = document.querySelectorAll('.image-container a');
    links.forEach(link => {
        link.addEventListener('click', function (e) {

            allCarouselItems.forEach((item) => {
                item.classList.remove("active");
            })

            const carouselItemTarget = document.querySelector(`.gallery .${e.currentTarget.dataset.carouselId}`)
            console.log(carouselItemTarget)
            carouselItemTarget.classList.add("active");

            const modal = document.getElementById(`dialog`)
            modal.showModal();
        })
    })

    const closeButton = document.querySelector('dialog .closeButton');
    closeButton.addEventListener('click', () => {

        closeButton.parentElement.close();
    })

    const gallery = document.getElementById('jGallery');
    closeButton.transition = 'opacity 0.25s';
    gallery.addEventListener('slid.bs.carousel', (event) => {
        closeButton.style.opacity = '1';
    })
    gallery.addEventListener('slide.bs.carousel', (event) => {
        closeButton.style.opacity = '0';
    })

})
$("#jGallery").justifiedGallery({
    rowHeight: 250,
    lastRow: 'justify',
    margins: 3
});
