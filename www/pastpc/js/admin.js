import { qs, getParam } from './utils.mjs';

const clientId = getParam("client-id");
console.log(`clientId is: ${clientId}`);
const reviewsURL = `/pastpc/reviews/index.php?action=get-client-reviews&client-id=${clientId}`;
getReviews(reviewsURL);

async function getReviews(url) {
    const response = await fetch(url);	
    if (response.ok) {
        const data = await response.json()
        buildReviewList(data);
    }							
}						
function buildReviewList(reviews) {	

    console.log("reviews: ", reviews);
    let rlist = "";
    if (reviews.length > 0)
        rlist += "<h2>User Reviews</h2>"

    for (const review of reviews) {
        rlist += `<p><a class="p-link" href="/pastpc/reviews/index.php?action=update-review&review-id=${review['reviewId']}">Edit</a> <a class="p-link" href="/pastpc/reviews/index.php?action=delete-review&review-id=${review['reviewId']}">Delete</a>`;
        rlist += ` "${review['reviewText']}"--`;
        rlist += review['clientFirstname'].substring(0, 1);
        rlist += `${review['clientLastname']}, ${review['reviewDate']}</p>`;
    }

    qs(".reviews").innerHTML = rlist;

}

