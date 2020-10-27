        <!-- Modal for checking if user really want to go bankrupt -->
        <div class="modal" id="profileBankruptModal" tabindex="-1" role="dialog">
            <div class="modal__content" id="profileBankruptModal-content">
                <div class="modal__header">
                    <h5 class="modal__title">Going bankrupt?</h5>
                    <button type="button" class="modal__close" aria-label="Close" onclick="closeModal('profileBankruptModal', 'profileBankruptModal-content')">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal__body">
                    <p class="modal__text">Are you sure you want to start over. When you click on this button your points will be rest to 1000. Al open bets wil also be cancelled. </p>
                    <p class="modal__text">Achievements and progress towards them will not be reset. </p>
                </div>

                <div class="modal__footer">
                    <button type="submit" class="modal__cancel" onclick="closeModal('profileBankruptModal', 'profileBankruptModal-content')">Cancel</button>
                    <form method="post" class="modal__form">
                        <button type="submit" name="btnStartOver" class="modal__submit">Start over</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
            // Checking if user clicked submit button
            if (isset($_POST["btnStartOver"])) {
                // Sending variables to the function
                $userCtrl->resetUserPoints($userModel);
            }
        ?>