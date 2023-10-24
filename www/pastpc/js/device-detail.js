import { setClick, select, getParam, toggleClasses, toggleClass, hasClass } from './utils.mjs'

setDefaultStates()
setClick(goBack, ".back-button")
setClick(toggleFullDescription, ".show-more-button")
renderReviews()

function setDefaultStates() {
    toggleClass('.detail-description', '.detail-description-short')
    select('.show-more-button-text').innerHTML = "Show more"
}

function goBack(e) {
    window.history.back()
}

function toggleFullDescription(e) {
    toggleClasses('.detail-description', '.detail-description-short', '.detail-description-full')
    if (hasClass('.detail-description', '.detail-description-short'))
        select('.show-more-button-text').innerHTML = "Show more"
    if (hasClass('.detail-description', '.detail-description-full'))
        select('.show-more-button-text').innerHTML = "Show less"
}

async function renderReviews() {
    const deviceId = getParam("device-id")
    const url = `/pastpc/reviews/index.php?action=get-reviews&device-id=${deviceId}`;
    const response = await fetch(url)
    if (response.ok) {
        const data = await response.json()
        buildReviewList(data)
    }							
}						
function buildReviewList(reviews) {	

    console.log("reviews: ", reviews)
    let rlist = ""

    for (const review of reviews) {
        rlist += `<p style="text-align: center;" class=".review-p">"${review['reviewText']}"--`;
        rlist += review['clientFirstname'].substring(0, 1)
        rlist += `${review['clientLastname']}, ${review['reviewDate']}</p>`;
    }

    select(".reviews").innerHTML = rlist
}

