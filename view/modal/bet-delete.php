    
        <!-- Modal for checking if user really wants to delete their bet -->
        <div class="modal" id="deleteBetModal" tabindex="-1" role="dialog">
            <div class="modal__content" id="deleteBetModal-content">
                <div class="modal__header">
                    <h5 class="modal__title">Delete this bet?</h5>
                    <button type="button" class="modal__close" aria-label="Close" onclick="closeModal('deleteBetModal', 'deleteBetModal-content')">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal__body">
                    <p class="modal__text">Are you sure you want to delete this bet. Once it is removed you can not get it bet.</p>
                </div>

                <div class="modal__footer">
                    <button type="submit" class="modal__cancel" onclick="closeModal('deleteBetModal', 'deleteBetModal-content')">Cancel</button>
                    <form method="post" class="modal__form">
                        <!-- Modal is filled with bet ID and points from javascript -->
                        <input type="hidden" name="txtBetID" id="betID" tabindex="-2">
                        <input type="hidden" name="txtBetPoints" id="betPoints" tabindex="-2">
                        <button type="submit" name="btnSubmit" class="modal__submit">Delete bet</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
            // Checking if user clicked submit button
            if (isset($_POST['btnSubmit'])) {
                $betID = htmlspecialchars($_POST['txtBetID']);
                $betPoints = htmlspecialchars($_POST['txtBetPoints']);

                // Sending variables to the function
                $betCtrl->deleteBet($betID, $betPoints, $userModel);
            }
        ?>