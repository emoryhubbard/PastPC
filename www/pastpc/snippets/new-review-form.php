<?php $cd = $_SESSION['clientData']; ?>
<form action="/pastpc/reviews/index.php" method="post">
                <fieldset>
                    <label>Leave a review:<span class="asterisk">*</span><input type="text" name="review-text" required placeholder=""></label>
                    <label>Screen name:<span class="asterisk"></span><input type="text" name="screen-name" readonly value="<?php echo substr($cd['clientFirstname'], 0, 1) . $cd['clientLastname']; ?>"></label>
                    <input class="submit-button" type="submit" value="Submit Review">
                    <input type="hidden" name="action" value="submit-add-review">
                    <input type="hidden" name="client-id" value=<?php echo $cd['clientId']; ?>>
                    <input type="hidden" name="inv-id" value=<?php echo $invInfo['invId']; ?>>
                </fieldset>
            </form>