        <!-- Modal for letting the user know they won an achievement -->
        <div class="modal" id="achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>" tabindex="-1" role="dialog">
            <div class="modal__content" id="achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>-content">
                <div class="modal__header">
                    <h5 class="modal__title"><?php echo $achievement->getUser()->getUsername(); ?> takes home the checkered flag on the '<?php echo $achievement->getAchievement()->getName(); ?>' achievement</h5>
                    <button type="button" class="modal__close" aria-label="Close" onclick="closeModal('achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>', 'achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>-content')">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal__body">
                    <p class="modal__text"><?php echo $achievement->getAchievement()->getDescription(); ?></p>
                </div>

                <div class="modal__footer">
                    <button type="submit" class="modal__cancel" onclick="closeModal('achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>', 'achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>-content')">Close</button>
                    <a href="achievement-overview" class="modal__submit modal--link">Check out</a>
                </div>
            </div>
        </div>

        <script>
            // Making the modal visible
            document.getElementById("achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>").classList.add("modal--visible");
            document.getElementById("achievementReceived<?php echo $achievement->getAchievement()->getID(); ?>-content").classList.add("modal__content-show");
        </script>