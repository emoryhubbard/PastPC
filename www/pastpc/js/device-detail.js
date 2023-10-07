import { qs, getParam } from './utils.mjs';

const invId = getParam("inv-id");
console.log(`invId is: ${invId}`);
const reviewsURL = `/pastpc/reviews/index.php?action=get-reviews&inv-id=${invId}`;
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

    for (const review of reviews) {
        rlist += `<p style="text-align: center;" class=".review-p">"${review['reviewText']}"--`;
        rlist += review['clientFirstname'].substring(0, 1);
        rlist += `${review['clientLastname']}, ${review['reviewDate']}</p>`;
    }

    qs(".reviews").innerHTML = rlist;

}

