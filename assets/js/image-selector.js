
function changeImage(src, element) {
    const mainImg = document.getElementById('main-image');
    mainImg.src = src;
    
    // Opcional: marca qual miniatura está selecionada
    document.querySelectorAll('.thumb-image').forEach(img => img.style.borderColor = 'transparent');
    element.style.borderColor = '#007bff';
}

let currentIndex = 0;

function changeImage(src, element) {
    // 1. Change the main image
    const mainImage = document.getElementById('main-image');
    if (mainImage) mainImage.src = src;

    // 2. Visual "active" state (optional but recommended)
    document.querySelectorAll('.thumb-image').forEach(img => img.classList.remove('border-primary', 'border-3'));
    if(element) element.classList.add('border-primary', 'border-3');
}

function scrollThumbs(direction) {
    const container = document.getElementById('thumb-container');
    const thumbs = container.querySelectorAll('.thumb-image');
    
    // 1. Update Index
    currentIndex += direction;
    if (currentIndex < 0) currentIndex = 0;
    if (currentIndex >= thumbs.length) currentIndex = thumbs.length - 1;

    const targetThumb = thumbs[currentIndex];

    // 2. Update Main Image
    changeImage(targetThumb.src, targetThumb);

    // 3. Manual Scroll Logic (No page jumping)
    const thumbHeight = targetThumb.offsetHeight;
    const gap = 10; // This should match the "gap" in your CSS
    
    /**
     * To make the active image stay in the "second position":
     * We scroll to the position of the image BEFORE it.
     * This moves index [currentIndex-1] to the top, 
     * putting [currentIndex] in the second slot.
     */
    const scrollTarget = (currentIndex - 1) * (thumbHeight + gap);

    container.scrollTo({
        top: Math.max(0, scrollTarget), // Math.max prevents negative scrolling
        behavior: 'smooth'
    });
}