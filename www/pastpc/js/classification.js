var images = []
var observer
initializeImages()
loadWhileScrolling()

function initializeImages() {
    let imageNodeList = document.querySelectorAll("img[data-src]")
    images = Array.from(imageNodeList)
}
function loadWhileScrolling() {
    observer = new IntersectionObserver(checkForIntersections)
    images.map(observeImage)
}
function checkForIntersections(events, observer) {
    events.map(respondToIntersection)
}
function respondToIntersection(e) {
    let image = e.target
    if (e.isIntersecting) {
        loadImage(image)
        observer.unobserve(image)
    }
}
function observeImage(image) {
    observer.observe(image)
}
function loadImage(image) {
    image.src = image.getAttribute("data-src"); //can't access .data-src directly
    image.onload = unblurImage     //since it has a hyphen
    
}
function unblurImage(e) {
    let image = e.target
    image.classList.add("unblur")
}