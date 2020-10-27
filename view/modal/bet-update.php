    
        <!-- Modal for checking if user really wants to update their bet -->
        <div class="modal" id="updateModal" tabindex="-1" role="dialog">
            <div class="modal__content" id="updateModal-content">
                <div class="modal__header">
                    <h5 class="modal__title">Update this bet?</h5>
                    <button type="button" class="modal__close" aria-label="Close" onclick="closeModal('updateModal', 'updateModal-content')">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal__body">
                    <p class="modal__text">Are you sure you want to update this bet?</p>
                </div>

                <div class="modal__footer">
                    <button type="submit" class="modal__cancel" onclick="closeModal('updateModal', 'updateModal-content')">Cancel</button>
                    <form method="post" class="modal__form">
                        <!-- Modal is filled with bet ID and points from javascript -->
                        <input type="hidden" name="txtBetID" id="updateBetID" tabindex="-2">
                        <input type="hidden" name="txtBetOnId" id="updateBetOnId" tabindex="-2">
                        <input type="hidden" name="txtBetPointsNew" id="updateBetPointsNew" tabindex="-2">
                        <input type="hidden" name="txtBetPointsOld" id="updateBetPointsOld" tabindex="-2">
                        <button type="submit" name="btnUpdateBet" class="modal__submit">Update bet</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
            // Checking if user clicked submit button
            if (isset($_POST['btnUpdateBet'])) {
                $betID = htmlspecialchars($_POST['txtBetID']);
                $betOnId = $_POST['txtBetOnId'];
                $betPointsNew = htmlspecialchars($_POST['txtBetPointsNew']);
                $betPointsOld = htmlspecialchars($_POST['txtBetPointsOld']);

                // Sending variables to the function
                $betCtrl->updateBet($betID, $betOnId, $betPointsNew, $betPointsOld, $userModel);
            }
        ?>