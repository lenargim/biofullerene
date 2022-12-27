<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<footer class="footer-checkout">
    <div class="container">
        <div class="footer-checkout__policy">
            <span>© 2022, Biofullerene</span>
			<?php wp_nav_menu( [
				'menu'       => 34,
				'container'  => false,
				'menu_class' => 'footer-checkout__policy-menu',
				'depth'      => 1,
			] ) ?>
        </div>
    </div>
</footer>
<div class="overlay">
    <div class="modal modal-help">
        <div class="close">
            <svg>
                <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#close"></use>
            </svg>
        </div>
        <div class="modal-help__title">
            <div class="pre">Help center</div>
            <div class="modal__title">Do you have any questions?</div>
        </div>
        <div class="modal-help__desc">What would you like help with today? You can quickly take care of most things
            here, or
            connect with us when needed.
        </div>
	    <?php wp_nav_menu( [
		    'menu'       => 'help',
		    'container'  => false,
		    'menu_class' => 'modal-help__list',
		    'depth'      => 1,
	    ] ) ?>
        <div class="modal-help__more">
            <div class="modal-help__more-title">Can not find your answer? Please contact us</div>
            <button class="modal-help__more-link open-modal-question" type="button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 2.00024L11 13.0002M22 2.00024L15 22.0002L11 13.0002M22 2.00024L2 9.00024L11 13.0002"
                          stroke="#121417" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Send a question</span>
            </button>
        </div>
        <div class="modal-help__footer">
            Or contact us by email anytime and we’ll get back<br>
            to you within 48 hours:
            <a href="mailto:<?php echo the_field( 'email', 159 ); ?>">
				<?php echo the_field( 'email', 159 ); ?></a>
        </div>
    </div>
    <div class="modal modal-question">
        <div class="modal-question__title">
            <span>Send a question</span>
            <div class="close">
                <svg>
                    <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#close"></use>
                </svg>
            </div>
        </div>
        <div class="modal-question__desc">Please try to describe your question as accurately as possible. The most
            complete information will help us promptly respond to your message.
        </div>
		<?php echo do_shortcode( '[contact-form-7 id="375" title="Modal question" html_class="modal-question__form"]' ); ?>
        <div class="modal-question__footer">By clicking on the "Submit question" button, I agree to the<br>
            <a href="<?php echo get_privacy_policy_url(); ?>" class="policy">privacy policy</a> and use of personal
            data
        </div>
    </div>
    <div class="modal modal-send">
        <div class="close closed">
            <svg>
                <use xlink:href="<?php echo IMAGES_PATH; ?>/sprite-common.svg#close"></use>
            </svg>
        </div>
        <div class="modal-send__wrap">
            <svg width="92" height="92" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M6.49494 72.5702L6.68018 72.2696C6.71909 72.0738 6.78624 71.8847 6.8795 71.708C6.96395 71.3364 7.46128 71.2157 7.83389 71.2978C8.1181 71.3776 8.39092 71.4917 8.64638 71.6375L8.64707 71.6366C8.8057 71.5391 8.99053 71.4935 9.17588 71.5064C9.34647 71.5281 9.50352 71.609 9.61915 71.735C9.82269 71.9078 9.50056 72.2291 9.15574 72.1245L9.14379 72.1635C9.08378 72.1496 9.02471 72.1326 8.96881 72.1128C8.90809 72.8106 8.79377 73.5029 8.62686 74.1838C8.56863 74.2564 8.48873 74.3089 8.39923 74.3342L7.43337 73.9587C13.8686 83.0266 24.1477 88.7543 36.9432 89.8187C36.7969 89.7299 36.6119 89.65 36.4127 89.5641C36.1931 89.4694 35.9558 89.3669 35.7331 89.2362C35.7161 89.2075 35.7023 89.177 35.6918 89.1454C35.6798 89.1094 35.6726 89.0724 35.6696 89.0344C35.6644 88.9631 35.6756 88.8916 35.7025 88.8253C35.7295 88.7589 35.7713 88.6995 35.8249 88.6519C35.8785 88.6042 35.9423 88.5692 36.0114 88.5498C36.2708 88.4904 36.5382 88.4756 36.8021 88.5049C36.8308 88.9058 36.8655 89.4051 36.883 89.7762C37.2147 89.6334 37.5858 89.6124 37.9303 89.7174C38.0784 89.7627 38.2175 89.8299 38.3431 89.9159C39.5444 89.9831 40.7668 90.0098 42.0093 89.9951C67.3392 89.6957 91.6965 72.3337 91.9974 47.0938C92.0774 40.3848 90.3011 34.0354 87.1739 28.334L87.0742 28.2638L87.1197 28.2355C86.1621 26.5005 85.0793 24.8258 83.8857 23.2196C83.6469 23.3721 83.3367 23.3112 82.9858 23.1042L82.9919 23.1881C82.7615 22.8733 82.5651 22.5823 82.3834 22.299C82.29 22.1534 82.2006 22.0101 82.1122 21.8663C82.1636 21.6393 82.2944 21.4991 82.4563 21.3926C81.8341 20.6363 81.1868 19.897 80.5163 19.1757C80.4869 19.1671 80.4579 19.157 80.4293 19.1453C79.7036 18.7136 79.0563 18.6083 78.5888 19.6024C78.5289 19.7006 78.4596 19.8123 78.3661 19.7463C78.2729 19.7383 78.1731 19.7431 78.0739 19.7479C77.8802 19.757 77.6877 19.766 77.5491 19.6816C77.3393 19.5538 77.0442 19.0949 77.1155 18.9948C77.2552 18.6502 77.2319 18.2793 77.2084 17.9091L77.2083 17.9069C77.1854 17.5405 77.1626 17.1749 77.2988 16.8374C77.5996 16.8492 77.9008 16.8514 78.2018 16.8437C73.8722 12.7544 68.7651 9.35132 63.2398 6.83969C63.3033 7.03987 63.344 7.24317 63.3305 7.4543C62.8183 7.60063 62.3145 7.77597 61.8224 7.97983C61.6782 8.01702 61.5313 8.04004 61.3839 8.04855C61.2391 8.05674 61.0936 8.05091 60.9494 8.03108C60.1966 7.82558 59.5168 7.41493 58.9863 6.84544C58.8637 6.8159 58.888 6.71926 58.9147 6.61262C58.9176 6.60125 58.9205 6.58976 58.9232 6.57824L58.9235 6.5772C58.9521 6.45808 58.9807 6.33921 59.0979 6.37475C59.2562 6.27724 59.4414 6.23166 59.6268 6.24459C60.2398 6.37998 60.7552 6.35849 61.0341 5.89348C54.6567 3.31828 47.8033 1.92185 40.9962 2.00232C39.8872 2.01543 38.7972 2.06745 37.7267 2.15707L37.5968 2.31215L37.5678 2.17067C33.8616 2.49445 30.3908 3.26979 27.1732 4.44186C27.2637 4.51636 27.3369 4.60955 27.3881 4.71542C27.4143 4.76965 27.4344 4.82635 27.4479 4.88454C27.4643 4.95575 27.4713 5.02927 27.4682 5.10311C27.3906 5.4642 27.0318 5.90264 26.6874 5.79801C26.4213 5.80361 26.1633 5.77543 25.8869 5.74521C25.6434 5.7186 25.3854 5.69042 25.0949 5.68236C24.9153 5.62666 24.7369 5.56762 24.5596 5.50526C9.16341 12.4499 0.232693 28.9526 0.00393713 48.1382C-0.109012 57.6115 2.21193 65.9122 6.49494 72.5702ZM12.2151 77.6262C12.1816 77.7152 12.1504 77.8056 12.1245 77.899C12.1016 77.8696 12.0783 77.8401 12.055 77.8106C11.7067 77.3694 11.3365 76.9005 11.7067 76.2953C11.7596 76.2098 11.817 76.1526 11.8784 76.1122C11.9671 76.0535 12.0635 76.0302 12.164 76.006C12.251 75.9848 12.3329 76.0343 12.3974 76.1103C12.4587 76.1824 12.5042 76.2779 12.5237 76.36C12.5448 76.4678 12.5472 76.5783 12.5307 76.6862C12.5196 76.7577 12.5002 76.8279 12.4728 76.8958C12.427 77.0899 12.3568 77.2666 12.2869 77.4423L12.2866 77.4431L12.2863 77.4438C12.2623 77.5042 12.2381 77.5652 12.2151 77.6262ZM33.4684 87.9332C33.4576 87.8911 33.4469 87.8496 33.3935 87.817C33.4192 87.9095 33.4303 87.9493 33.4538 87.9795C33.4713 88.0021 33.4957 88.0194 33.5388 88.0498C33.4896 88.0151 33.4789 87.9738 33.4684 87.9332ZM36.7878 88.3049L36.7938 88.3888C36.5634 88.0741 36.367 87.783 36.1853 87.4998C36.0919 87.3542 36.0025 87.2108 35.9141 87.0671C35.9981 86.6958 36.2947 86.5568 36.5921 86.4175C36.8903 86.2774 37.1894 86.1368 37.2763 85.7612C37.3009 85.7209 37.3154 85.6971 37.3357 85.6802C37.3648 85.6561 37.4059 85.6462 37.5057 85.6221C38.0262 85.512 38.5676 85.5799 39.043 85.8149C39.5183 86.05 39.8993 86.4383 40.1244 86.9171C40.1244 86.9171 40.0791 87.0605 40.0022 87.1751C39.9587 87.2402 39.905 87.2958 39.8436 87.3107C39.7592 87.3311 39.6665 87.3108 39.5737 87.2904L39.5715 87.2899C39.4787 87.2694 39.386 87.2491 39.3016 87.2695C39.0266 87.2149 38.7407 87.2626 38.4978 87.4038C38.2551 87.5448 38.072 87.7694 37.9835 88.0349C37.743 88.5974 37.3105 88.6134 36.7878 88.3049ZM31.0102 83.1077L31.0104 83.1099C31.0338 83.4801 31.0571 83.851 30.9174 84.1956C30.8462 84.2957 31.1412 84.7546 31.3511 84.8824C31.4896 84.9667 31.6817 84.9578 31.8754 84.9487C31.9746 84.9439 32.0748 84.9391 32.1681 84.9471C32.2615 85.0131 32.3308 84.9014 32.3907 84.8032C32.8582 83.8091 33.5055 83.9144 34.2313 84.3461C34.4029 84.4163 34.5929 84.4308 34.7736 84.3875C34.8735 84.458 34.938 84.3539 35.0027 84.2495L35.0033 84.2486L35.012 84.2346L35.0221 84.2186C35.0811 84.1255 35.1345 84.0412 35.0276 83.9748C34.7038 83.2674 34.1886 82.6644 33.5396 82.2337C33.4091 82.1698 33.273 82.1188 33.1332 82.0813C32.9907 82.0434 32.8442 82.0193 32.6958 82.0097C32.1651 82.0497 31.6323 82.0591 31.1007 82.0382C30.9645 82.3757 30.9874 82.7413 31.0102 83.1077ZM30.2325 87.4529C30.2728 87.4564 30.3117 87.455 30.3481 87.4448L30.3719 87.4113C30.3871 87.4771 30.4169 87.5384 30.4596 87.5911C30.5019 87.6435 30.556 87.6859 30.6172 87.7148C30.6336 87.7738 30.6579 87.8198 30.6788 87.8592C30.7152 87.9282 30.7411 87.9771 30.6956 88.0407C30.7033 88.2119 30.6506 88.3804 30.5469 88.5175C30.2354 88.7993 29.7821 88.3795 29.5583 87.8205L29.576 87.7571L29.5763 87.756C29.6116 87.6247 29.6619 87.4379 29.8058 87.4033C29.8898 87.383 29.9836 87.4041 30.0767 87.425C30.1295 87.4369 30.1821 87.4487 30.2325 87.4529ZM25.7274 83.384C25.4334 83.1767 25.0268 83.3816 25.1654 83.6096C25.2354 83.7655 25.3588 83.8916 25.5137 83.9655C25.6854 84.0357 25.875 84.0501 26.056 84.007C26.3141 83.8278 26.0656 83.5424 25.751 83.3506L25.7274 83.384ZM43.7466 88.9998C43.8289 88.9769 43.9231 88.9981 44.018 89.0194C44.1112 89.0404 44.205 89.0615 44.2889 89.0413L44.3129 89.008C44.3208 89.0469 44.335 89.0897 44.3495 89.1333C44.3961 89.2736 44.4455 89.4224 44.2981 89.4792C44.2742 89.5067 44.2473 89.5314 44.2177 89.5526C44.1933 89.5701 44.1673 89.5852 44.1399 89.5979C44.1084 89.6121 44.0756 89.6229 44.042 89.6299C44.0107 89.6366 43.9788 89.6398 43.9467 89.6396C43.8798 89.6391 43.8141 89.6246 43.7538 89.5963C43.7086 89.5753 43.6672 89.5469 43.6313 89.5124C43.6196 89.5012 43.6082 89.4892 43.5975 89.4764C43.5888 89.3052 43.6415 89.1362 43.7466 88.9998ZM26.466 85.6699C26.2655 85.5286 26.0932 85.5875 26.0688 85.8613C26.0023 85.9547 26.0426 86.1236 26.1072 86.0187C26.2074 86.0893 26.4867 86.1058 26.5466 86.0077L26.5494 86.003C26.6094 85.9049 26.6964 85.7626 26.4897 85.6365L26.466 85.6699ZM28.0451 83.3135C28.0205 83.587 27.9224 83.5277 27.7772 83.295L27.9066 83.0854C27.9221 83.176 27.9717 83.2576 28.0451 83.3135ZM29.0775 80.4586C29.0666 80.4165 29.0559 80.375 29.0025 80.3424C29.0282 80.4349 29.0393 80.4747 29.0628 80.5049C29.0803 80.5275 29.1047 80.5448 29.1478 80.5752C29.0986 80.5405 29.0879 80.4992 29.0775 80.4586ZM25.8415 79.9783C25.8818 79.9818 25.9208 79.9804 25.9571 79.9702L25.9809 79.9366C25.9962 80.0025 26.0259 80.0638 26.0686 80.1165C26.111 80.1689 26.165 80.2113 26.2262 80.2402C26.2426 80.2992 26.2669 80.3451 26.2878 80.3846C26.3242 80.4535 26.3502 80.5025 26.3046 80.5661C26.3123 80.7373 26.2596 80.9058 26.1559 81.0429C25.8444 81.3247 25.3912 80.9049 25.1673 80.3459L25.185 80.2825L25.1853 80.2814C25.2206 80.1501 25.2709 79.9632 25.4148 79.9287C25.4988 79.9084 25.5926 79.9295 25.6857 79.9504C25.7386 79.9623 25.7911 79.9741 25.8415 79.9783ZM21.3364 75.9094C21.0424 75.7021 20.6359 75.907 20.7745 76.1349C20.8444 76.2909 20.9678 76.417 21.1227 76.4909C21.2944 76.5611 21.484 76.5755 21.6651 76.5323C21.9231 76.3532 21.6747 76.0678 21.36 75.8759L21.3364 75.9094ZM21.6779 78.3867C21.7022 78.1129 21.8746 78.054 22.0751 78.1953L22.0987 78.1619C22.3055 78.288 22.2185 78.4303 22.1585 78.5284L22.1556 78.5331C22.0957 78.6312 21.8165 78.6147 21.7162 78.544C21.6516 78.6489 21.6113 78.48 21.6779 78.3867ZM23.3862 75.8204C23.5314 76.0531 23.6295 76.1124 23.6541 75.8389C23.5807 75.783 23.5311 75.7014 23.5156 75.6108L23.3862 75.8204ZM18.2417 81.4583L18.2416 81.4561C18.2187 81.0897 18.1959 80.7242 18.332 80.3866C18.8637 80.4075 19.3964 80.3982 19.9272 80.3581C20.0756 80.3678 20.2221 80.3918 20.3645 80.4298C20.5044 80.4672 20.6405 80.5183 20.771 80.5822C21.42 81.0129 21.9352 81.6158 22.2589 82.3232C22.3658 82.3896 22.3124 82.474 22.2535 82.567C22.2472 82.5769 22.2408 82.587 22.2346 82.5971L22.2341 82.598C22.1694 82.7023 22.1049 82.8064 22.0049 82.736C21.8242 82.7793 21.6343 82.7647 21.4626 82.6945C20.7369 82.2629 20.0896 82.1576 19.6221 83.1517C19.5622 83.2498 19.4929 83.3615 19.3994 83.2955C19.3062 83.2875 19.2064 83.2923 19.1071 83.2971C18.9135 83.3062 18.721 83.3152 18.5824 83.2309C18.3726 83.103 18.0775 82.6442 18.1488 82.544C18.2884 82.1995 18.2651 81.8286 18.2417 81.4583ZM23.8186 73.3606C23.8225 73.2657 23.8237 73.1703 23.8189 73.0737C23.85 73.0944 23.8814 73.115 23.9129 73.1358C24.383 73.4452 24.8827 73.774 24.7211 74.4635C24.6977 74.561 24.6611 74.6332 24.6154 74.6907C24.5495 74.7741 24.4651 74.8263 24.3772 74.8806C24.3011 74.9279 24.2077 74.9066 24.1224 74.8547C24.0414 74.8055 23.968 74.7292 23.9237 74.6575C23.8696 74.5619 23.8326 74.4578 23.8143 74.3504C23.8025 74.2792 23.7988 74.2065 23.8035 74.1336C23.7859 73.9353 23.7971 73.7458 23.8082 73.5574C23.8121 73.4918 23.816 73.4263 23.8186 73.3606ZM30.7685 76.7093L30.9372 75.9996C31.0098 75.7651 30.7176 75.326 30.4573 75.3923L28.4838 75.2892C28.4066 75.341 28.3472 75.4159 28.3147 75.5029C28.3736 76.2431 28.4929 76.9769 28.6714 77.6974C28.6352 77.8146 28.7627 77.8446 28.8828 77.8727C29.2391 77.9678 29.6081 78.0076 29.9771 77.9911C30.3573 77.9525 30.7923 77.6827 30.7557 77.304C30.7888 77.1073 30.7931 76.9071 30.7685 76.7093ZM8.05124 69.8825C8.11429 70.1497 7.96891 70.2594 7.73374 70.1881L7.7218 70.2272C7.48547 70.1723 7.52342 70.0102 7.54959 69.8984L7.55084 69.893C7.57689 69.7813 7.8477 69.7097 7.96528 69.7453C7.99369 69.6257 8.08514 69.7732 8.05124 69.8825ZM33.9104 76.637L34.0193 76.2853C34.0025 76.227 33.9701 76.1742 33.9259 76.1325C33.8816 76.0909 33.827 76.0616 33.7677 76.048C33.7366 76.0409 33.7046 76.038 33.6732 76.0396C33.6443 76.0411 33.6157 76.0462 33.5877 76.0547C33.5294 76.0727 33.477 76.1059 33.4356 76.1509L33.3627 76.3853C33.4185 76.5644 33.6578 76.6201 33.8973 76.6759L33.8981 76.676L33.9104 76.637ZM10.0116 75.4328C10.043 75.4117 10.0796 75.3982 10.1191 75.389C10.1683 75.3772 10.222 75.3719 10.276 75.3667C10.3711 75.3574 10.467 75.3481 10.5405 75.3026C10.6665 75.2249 10.6555 75.0321 10.6477 74.8965L10.6477 74.8954L10.6445 74.8298C10.2557 74.3698 9.69253 74.1134 9.48496 74.4779C9.42954 74.6402 9.43244 74.8164 9.49364 74.9763C9.47032 75.0509 9.51037 75.0892 9.56675 75.1432C9.599 75.1741 9.63659 75.2101 9.67072 75.2609C9.73808 75.2691 9.8028 75.2924 9.8596 75.3289C9.91672 75.3655 9.96435 75.4143 9.99962 75.472L10.0116 75.4328ZM16.1477 77.4492C16.3512 77.622 16.0291 77.9433 15.6843 77.8386L15.6723 77.8777C15.3127 77.7942 14.9866 77.6012 15.1756 77.3508C15.3342 77.2532 15.5191 77.2077 15.7044 77.2206C15.875 77.2422 16.0321 77.3232 16.1477 77.4492ZM14.2623 75.9023C14.4974 75.9736 14.6428 75.8639 14.5798 75.5967C14.6137 75.4874 14.5222 75.3399 14.4938 75.4595C14.3762 75.4239 14.1054 75.4955 14.0794 75.6072L14.0781 75.6126C14.052 75.7243 14.014 75.8864 14.2503 75.9414L14.2623 75.9023ZM13.5022 78.6298C13.4395 78.3627 13.5514 78.3883 13.7628 78.5636L13.7057 78.8027C13.6624 78.7216 13.5896 78.6598 13.5022 78.6298ZM16.8818 71.6129L16.881 71.6108C16.7422 71.2672 16.6033 70.9228 16.6277 70.5524C16.6639 70.4353 16.2389 70.0924 15.9991 70.0368C15.8408 70.0002 15.6609 70.0687 15.4796 70.1378C15.3867 70.1734 15.2929 70.2093 15.2017 70.2308C15.0921 70.1975 15.0613 70.3251 15.0353 70.4368C14.9035 71.5254 14.2548 71.6278 13.4287 71.4454C13.2433 71.4324 13.0581 71.478 12.8999 71.5755C12.7826 71.54 12.7541 71.6588 12.7254 71.778L12.7251 71.779C12.7224 71.7905 12.7195 71.802 12.7167 71.8134C12.6899 71.92 12.6656 72.0167 12.7882 72.0462C13.3188 72.6157 13.9985 73.0264 14.7513 73.2318C14.8955 73.2517 15.041 73.2575 15.1858 73.2493C15.3332 73.2408 15.4801 73.2178 15.6243 73.1806C16.1165 72.9767 16.6202 72.8014 17.1324 72.6551C17.1556 72.2925 17.0189 71.9531 16.8818 71.6129ZM58.3226 12.6982C58.3485 12.6048 58.3797 12.5145 58.4132 12.4254C58.4364 12.3638 58.4607 12.3027 58.485 12.2416C58.5548 12.0658 58.6251 11.8891 58.6709 11.695C58.6982 11.6272 58.7176 11.5569 58.7288 11.4854C58.7453 11.3775 58.7429 11.267 58.7217 11.1592C58.7023 11.0771 58.6568 10.9816 58.5955 10.9096C58.5309 10.8335 58.4491 10.784 58.3621 10.8052C58.2616 10.8294 58.1651 10.8527 58.0765 10.9115C58.015 10.9519 57.9576 11.0091 57.9047 11.0945C57.5345 11.6997 57.9047 12.1686 58.2531 12.6098C58.2764 12.6394 58.2997 12.6688 58.3226 12.6982ZM79.6665 22.7324C79.6557 22.6903 79.645 22.6488 79.5916 22.6163C79.6172 22.7087 79.6284 22.7486 79.6519 22.7787C79.6693 22.8014 79.6937 22.8186 79.7368 22.849C79.6876 22.8144 79.677 22.7731 79.6665 22.7324ZM83.0001 23.3041C83.0289 23.705 83.0636 24.2044 83.081 24.5754C83.4127 24.4326 83.7839 24.4117 84.1283 24.5166C84.4726 24.6218 84.7676 24.8457 84.9602 25.1483C85.0854 25.2825 85.1517 25.4603 85.1451 25.6437C85.1386 25.8269 85.0597 26.0006 84.9254 26.1267C84.8591 26.1897 84.7806 26.2387 84.6952 26.2714C84.6441 26.291 84.5908 26.3042 84.5367 26.3112C84.5006 26.316 84.4639 26.3178 84.4271 26.3164C84.3359 26.3138 84.2461 26.293 84.163 26.2552C84.1227 26.2366 84.0844 26.2144 84.0485 26.1888C84.0105 26.1617 83.9754 26.1306 83.9436 26.0963C83.4927 25.7272 83.205 25.197 83.1412 24.6179C82.995 24.5291 82.81 24.4493 82.6108 24.3634C82.3912 24.2686 82.1538 24.1661 81.9312 24.0354C81.9141 24.0067 81.9004 23.9762 81.8898 23.9446C81.8779 23.9086 81.8707 23.8717 81.8676 23.8336C81.8624 23.7624 81.8737 23.6908 81.9006 23.6245C81.9275 23.5581 81.9694 23.4988 82.023 23.4511C82.0766 23.4034 82.1403 23.3685 82.2094 23.349C82.4689 23.2896 82.7363 23.2748 83.0001 23.3041ZM52.4949 7.69099L52.8783 7.06881C52.9172 6.87301 52.9843 6.68392 53.0776 6.50727C53.162 6.13559 53.6593 6.01493 54.032 6.09705C54.3162 6.1768 54.589 6.29088 54.8445 6.43672L54.8451 6.43579C55.0038 6.33828 55.1886 6.29269 55.374 6.30562C55.5445 6.32728 55.7016 6.40827 55.8172 6.53423C56.0208 6.70704 55.6986 7.02832 55.3538 6.92369L55.3419 6.96274C55.2819 6.9488 55.2228 6.93181 55.1669 6.91202C55.1062 7.60983 54.9918 8.30209 54.8249 8.98301C54.7667 9.05559 54.6868 9.10816 54.5973 9.13339L52.7588 8.41861C52.4911 8.40035 52.3523 7.89134 52.4949 7.69099ZM76.4306 22.2521C76.4708 22.2557 76.5098 22.2543 76.5462 22.244L76.5699 22.2105C76.5852 22.2764 76.615 22.3377 76.6576 22.3903C76.7 22.4428 76.754 22.4851 76.8153 22.514C76.8317 22.573 76.856 22.619 76.8768 22.6584C76.9133 22.7274 76.9392 22.7764 76.8936 22.84C76.9013 23.0112 76.8486 23.1796 76.745 23.3167C76.4335 23.5985 75.9802 23.1787 75.7564 22.6197L75.7741 22.5564L75.7743 22.5553C75.8097 22.4239 75.86 22.2371 76.0039 22.2026C76.0879 22.1822 76.1817 22.2033 76.2748 22.2243C76.3276 22.2361 76.3802 22.2479 76.4306 22.2521ZM71.9254 18.1832C71.6314 17.9759 71.2249 18.1808 71.3635 18.4088C71.4335 18.5647 71.5569 18.6908 71.7118 18.7647C71.8835 18.8349 72.073 18.8493 72.2541 18.8062C72.5121 18.627 72.2637 18.3416 71.949 18.1498L71.9254 18.1832ZM72.6641 20.4691C72.4636 20.3278 72.2912 20.3867 72.2669 20.6606C72.2004 20.7539 72.2407 20.9228 72.3052 20.8179C72.4055 20.8885 72.6848 20.9051 72.7446 20.8069L72.7475 20.8022C72.8075 20.7041 72.8945 20.5618 72.6877 20.4357L72.6641 20.4691ZM49.6629 6.45618L49.8768 6.15573L49.9008 6.12244L49.9015 6.12287C50.111 6.25071 50.3203 6.37848 50.3169 6.56631L50.174 6.76639C50.1206 6.79622 50.0604 6.81149 49.9994 6.81033C49.9703 6.80974 49.9415 6.80564 49.9137 6.79802C49.8834 6.78975 49.854 6.77692 49.8267 6.76044C49.7747 6.72903 49.7322 6.68404 49.7033 6.63069C49.6745 6.5772 49.6604 6.51691 49.6629 6.45618ZM74.2431 18.1127C74.2185 18.3863 74.1205 18.3269 73.9752 18.0942L74.1047 17.8846C74.1201 17.9753 74.1698 18.0568 74.2431 18.1127ZM75.2755 15.2578C75.2647 15.2157 75.254 15.1742 75.2006 15.1416C75.2263 15.2341 75.2374 15.2739 75.2609 15.3041C75.2784 15.3267 75.3028 15.344 75.3458 15.3744C75.2966 15.3397 75.286 15.2985 75.2755 15.2578ZM72.0396 14.7775C72.0798 14.7811 72.1188 14.7797 72.1552 14.7694L72.1789 14.7359C72.1942 14.8018 72.224 14.8631 72.2667 14.9157C72.309 14.9681 72.3631 15.0105 72.4243 15.0394C72.4407 15.0984 72.465 15.1444 72.4859 15.1838C72.5223 15.2528 72.5482 15.3018 72.5026 15.3654C72.5103 15.5366 72.4576 15.705 72.354 15.8421C72.0425 16.1239 71.5892 15.7041 71.3654 15.1451L71.3831 15.0817L71.3834 15.0806C71.4187 14.9493 71.469 14.7625 71.6129 14.728C71.6969 14.7076 71.7907 14.7287 71.8838 14.7496C71.9366 14.7615 71.9892 14.7733 72.0396 14.7775ZM67.5344 10.7086C67.2405 10.5013 66.8339 10.7062 66.9725 10.9342C67.0425 11.0901 67.1659 11.2162 67.3208 11.2901C67.4925 11.3603 67.682 11.3747 67.8631 11.3316C68.1212 11.1524 67.8727 10.867 67.5581 10.6752L67.5344 10.7086ZM67.8759 13.186C67.9003 12.9121 68.0726 12.8532 68.2731 12.9945L68.2968 12.9611C68.5035 13.0872 68.4165 13.2295 68.3565 13.3276L68.3537 13.3323C68.2938 13.4304 68.0145 13.4139 67.9143 13.3433C67.8497 13.4482 67.8094 13.2793 67.8759 13.186ZM69.5843 10.6196C69.7295 10.8523 69.8276 10.9116 69.8521 10.6381C69.7788 10.5822 69.7292 10.5007 69.7137 10.41L69.5843 10.6196ZM64.4398 16.2575L64.4396 16.2554C64.4168 15.8889 64.394 15.5234 64.5301 15.1859C65.0617 15.2068 65.5945 15.1974 66.1252 15.1573C66.2736 15.167 66.4202 15.191 66.5626 15.229C66.7024 15.2665 66.8386 15.3175 66.969 15.3814C67.618 15.8121 68.1332 16.4151 68.457 17.1225C68.5639 17.1889 68.5105 17.2732 68.4516 17.3662C68.4453 17.3762 68.4389 17.3862 68.4327 17.3963L68.4321 17.3972C68.3675 17.5016 68.303 17.6057 68.203 17.5352C68.0223 17.5785 67.8323 17.564 67.6607 17.4938C66.9349 17.0621 66.2876 16.9568 65.8201 17.9509C65.7603 18.049 65.6909 18.1607 65.5975 18.0948C65.5043 18.0868 65.4045 18.0916 65.3052 18.0964C65.1115 18.1054 64.9191 18.1144 64.7805 18.0301C64.5707 17.9022 64.2756 17.4434 64.3468 17.3433C64.4865 16.9987 64.4632 16.6278 64.4398 16.2575ZM46.6677 5.11657C46.6067 5.10236 46.5835 5.06641 46.5599 5.02984C46.5372 4.99459 46.514 4.95878 46.4563 4.94129C46.5069 4.95663 46.5355 4.96539 46.5593 4.98138C46.5911 5.00266 46.6142 5.03694 46.6677 5.11657ZM42.7325 4.34965C42.8658 4.69598 43.0561 5.15853 43.2095 5.5296C43.4697 5.47498 43.7194 5.37734 43.9474 5.23996C44.007 5.19993 44.0567 5.14688 44.0926 5.08492C44.1286 5.02297 44.1497 4.95359 44.1544 4.88223C44.1591 4.81103 44.1473 4.73965 44.12 4.67371C44.1051 4.6386 44.0866 4.6058 44.0639 4.57546C44.0439 4.54876 44.0212 4.52418 43.996 4.50225C43.7431 4.44793 43.4851 4.42493 43.2464 4.40374C43.0299 4.38453 42.8289 4.36665 42.6619 4.32818C42.419 3.79902 41.9785 3.38631 41.4335 3.17727C41.3924 3.15468 41.3493 3.13621 41.3046 3.12235C41.2624 3.10931 41.219 3.10022 41.1748 3.09526C41.0839 3.08533 40.992 3.0937 40.9043 3.11971C40.869 3.12991 40.8346 3.1431 40.8017 3.15891C40.7526 3.18246 40.7059 3.21161 40.6636 3.2462C40.5926 3.30386 40.5334 3.37488 40.4902 3.4553C40.4021 3.61679 40.3817 3.80615 40.4333 3.98187C40.4847 4.15775 40.6037 4.30565 40.765 4.39372C41.0434 4.62046 41.3944 4.74058 41.7549 4.73264C42.1156 4.72453 42.462 4.58869 42.7325 4.34965ZM43.2539 5.63708L43.2861 5.71472C42.6919 5.5856 42.2856 5.73593 42.2339 6.34442C42.2333 6.62379 42.1298 6.89388 41.9433 7.10346C41.7568 7.31321 41.4999 7.44777 41.2212 7.48194C41.1473 7.52771 41.0528 7.53735 40.9581 7.547L40.9558 7.54722C40.8611 7.55687 40.7666 7.56651 40.6927 7.61228C40.6391 7.64556 40.6054 7.71509 40.5846 7.7904C40.5476 7.92307 40.5496 8.07323 40.5496 8.07323C40.9143 8.45673 41.3989 8.7058 41.9249 8.78017C42.451 8.85438 42.9872 8.74959 43.4477 8.4826C43.535 8.42854 43.5709 8.40633 43.591 8.37433C43.605 8.352 43.6113 8.32492 43.6221 8.27894C43.5864 7.89578 43.8266 7.66909 44.0661 7.44308C44.3051 7.21803 44.5435 6.99354 44.5066 6.61527C44.3772 6.5066 44.2471 6.39859 44.1124 6.28976C43.8505 6.07803 43.5721 5.86349 43.2539 5.63708ZM50.4157 8.83452L50.4165 8.83657C50.5536 9.17678 50.6904 9.51622 50.6671 9.87874C50.1549 10.0251 49.6512 10.2004 49.159 10.4043C49.0149 10.4415 48.868 10.4645 48.7205 10.473C48.5758 10.4812 48.4302 10.4754 48.286 10.4555C47.5332 10.25 46.8535 9.83937 46.3229 9.26989C46.2004 9.24035 46.2246 9.14371 46.2514 9.03708C46.2542 9.0257 46.2571 9.01422 46.2599 9.00269L46.2601 9.00165C46.2888 8.88252 46.3173 8.76366 46.4346 8.79921C46.5928 8.7017 46.778 8.65611 46.9634 8.66903C47.7895 8.85148 48.4382 8.74904 48.57 7.66046C48.596 7.54872 48.6268 7.42117 48.7365 7.4545C48.8276 7.43295 48.921 7.39722 49.0139 7.36165C49.1952 7.29254 49.3755 7.22386 49.5338 7.26049C49.7736 7.31612 50.1987 7.65895 50.1624 7.77612C50.138 8.14646 50.2769 8.49082 50.4157 8.83452ZM33.8339 6.43168C33.8578 6.46762 33.8811 6.50258 33.8642 6.55696C33.7636 6.64032 33.6925 6.75368 33.6614 6.88025C33.3904 6.92218 33.1137 6.90262 32.852 6.82325C32.5903 6.74387 32.3502 6.60648 32.1496 6.42131C32.0273 6.39208 32.0515 6.2955 32.0783 6.18889L32.0828 6.17093L32.0868 6.15444C32.1152 6.0348 32.1436 5.91515 32.2612 5.9508C32.5248 5.85744 32.8096 5.84074 33.0816 5.90216C33.354 5.96358 33.6025 6.1008 33.7991 6.298C33.7848 6.35799 33.8097 6.39541 33.8339 6.43168ZM49.6812 4.51779C49.7126 4.4967 49.7492 4.48319 49.7886 4.47398C49.8378 4.46219 49.8915 4.45697 49.9455 4.45172C50.0406 4.44246 50.1365 4.43313 50.21 4.38762C50.336 4.30993 50.325 4.11711 50.3173 3.98152L50.3172 3.98039L50.3141 3.91479C49.9253 3.45479 49.3621 3.19845 49.1545 3.56295C49.0991 3.72527 49.102 3.90147 49.1632 4.06137C49.1399 4.13591 49.1799 4.17425 49.2363 4.22823C49.2685 4.2591 49.3061 4.2951 49.3403 4.34591C49.4076 4.35418 49.4723 4.37744 49.5291 4.41389C49.5863 4.4505 49.6339 4.49931 49.6692 4.55701L49.6812 4.51779ZM36.1849 7.2968C36.2819 7.2874 36.3782 7.27806 36.4493 7.23058C36.5063 7.06842 36.5032 6.89173 36.441 6.73216C36.4367 6.72953 36.4324 6.72697 36.4281 6.72449L36.4212 6.72061L36.4148 6.71722C36.4091 6.71419 36.4033 6.71131 36.3975 6.70858C36.3526 6.68713 36.3043 6.6731 36.2547 6.66732C36.1884 6.65938 36.1213 6.66611 36.0576 6.68652C36.0269 6.6964 35.9976 6.70941 35.97 6.72555C35.9402 6.74268 35.9125 6.7631 35.8869 6.7865C35.8822 6.7909 35.8776 6.7954 35.8731 6.79998C35.8689 6.80423 35.8647 6.80856 35.8607 6.81296L35.8519 6.82277L35.8446 6.83143L35.8386 6.8388C35.8347 6.8437 35.8309 6.84868 35.8272 6.85373C35.8057 6.88306 35.7879 6.91486 35.7738 6.94848C35.6515 7.04838 35.7453 7.17398 35.8338 7.2924C35.8425 7.304 35.8511 7.31553 35.8594 7.32697C35.8672 7.33755 35.8747 7.34806 35.8818 7.35846C35.8914 7.37246 35.9003 7.38626 35.9081 7.3998L35.9205 7.36075C35.9939 7.31532 36.0897 7.30602 36.1849 7.2968ZM54.2493 4.68172C54.3124 4.94892 54.167 5.05863 53.9318 4.98733L53.9199 5.0264C53.6835 4.97148 53.7215 4.80939 53.7477 4.6976L53.7489 4.69224C53.775 4.5805 54.0458 4.50891 54.1634 4.54456C54.1918 4.42491 54.2832 4.57245 54.2493 4.68172ZM53.1963 10.8308C53.1352 10.8165 53.112 10.7806 53.0884 10.744C53.0657 10.7088 53.0426 10.673 52.9849 10.6555C53.0354 10.6708 53.064 10.6796 53.0878 10.6956C53.1196 10.7168 53.1427 10.7511 53.1963 10.8308ZM56.2097 10.232C56.2411 10.2109 56.2777 10.1974 56.3171 10.1882C56.3664 10.1764 56.4201 10.1711 56.474 10.1659C56.5692 10.1566 56.665 10.1473 56.7385 10.1018C56.8645 10.0241 56.8535 9.83132 56.8458 9.69573L56.8457 9.69458L56.8426 9.62897C56.4538 9.16898 55.8906 8.91264 55.683 9.27714C55.6276 9.43946 55.6305 9.61566 55.6917 9.77556C55.6684 9.8501 55.7084 9.88844 55.7648 9.94242C55.7971 9.9733 55.8347 10.0093 55.8688 10.0601C55.9362 10.0684 56.0009 10.0916 56.0577 10.1281C56.1148 10.1647 56.1624 10.2135 56.1977 10.2712L56.2097 10.232ZM62.3457 12.2484C62.5493 12.4212 62.2272 12.7425 61.8823 12.6379L61.8704 12.6769C61.5107 12.5934 61.1847 12.4004 61.3737 12.15C61.5323 12.0525 61.7171 12.0069 61.9025 12.0198C62.0731 12.0415 62.2301 12.1225 62.3457 12.2484ZM60.4604 10.7015C60.6955 10.7728 60.8409 10.6631 60.7778 10.3959C60.8117 10.2866 60.7203 10.1391 60.6919 10.2587C60.5743 10.2231 60.3035 10.2947 60.2774 10.4064L60.2762 10.4118C60.25 10.5236 60.2121 10.6857 60.4484 10.7406L60.4604 10.7015ZM59.7003 13.429C59.6376 13.162 59.7495 13.1875 59.9609 13.3628L59.9038 13.602C59.8605 13.5209 59.7876 13.459 59.7003 13.429Z"
                      fill="#C7F5D5"/>
                <path d="M56 45.0799V45.9999C55.9988 48.1563 55.3005 50.2545 54.0093 51.9817C52.7182 53.7088 50.9033 54.9723 48.8354 55.5838C46.7674 56.1952 44.5573 56.1218 42.5345 55.3744C40.5117 54.6271 38.7847 53.246 37.611 51.4369C36.4373 49.6279 35.8798 47.4879 36.0217 45.3362C36.1636 43.1844 36.9972 41.1362 38.3983 39.4969C39.7994 37.8577 41.6928 36.7152 43.7962 36.24C45.8996 35.7648 48.1003 35.9822 50.07 36.8599M56 37.9999L46 48.0099L43 45.0099"
                      stroke="#00A352" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="modal-send__title">Question sent successfully</div>
            <div class="modal-send__desc">Thank you for contacting us, we will answer your question on <span
                        class="thx-email">example@gmail.com</span> within 72 hours!
            </div>
        </div>
        <button class="closed-bottom button white">Close</button>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
