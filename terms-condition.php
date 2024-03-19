<?php include('includes/header.php');
if (isset($_GET['type']) && $_GET['type'] == 'vendor') {
    $TypeUser = "Vendor";
} else {
    $TypeUser = "User";
}
?>
<!-- header end here -->

<style>
    .terms_condition_page {
        border-top: 1px solid #f1f1f1e6;
    }

    .terms_condition_page .ec-common-wrapper {
        padding: 30px;
        border: 1px solid #ededed7a;
        max-width: 100%;
        border-radius: 15px;
        margin: 0 auto;
        background-color: #f9fffe5c;
    }

    .terms_condition_page .section-title .ec-title {
        font-family: inherit;
        font-weight: 700;
        margin-bottom: 7px;
        color: #eca207;
        letter-spacing: 0;
        position: relative;
        display: inline;
        line-height: 22px;
        letter-spacing: 0.02rem;
        text-transform: capitalize;
    }

    .ec-cms-block .ec-cms-block-title {
        margin-bottom: 5px;
        color: #455263;
        font-size: 16px;
        line-height: 24px;
        font-weight: 600;
        letter-spacing: 0;
        text-align: left;
        /* font-family: "Montserrat"; */
    }

    .terms_condition_page .ec-cms-block p {
        margin-bottom: 29px;
    }

    .ec-cms-block p {
        font-size: 13px;
        color: #777777;
        line-height: 26px;
        font-weight: 400;
        letter-spacing: 0;
        text-align: left;
        margin-bottom: 14px !important;
    }

    p:last-child {
        margin-bottom: 0;
    }

    .terms_condition_page .section-title {
        margin-bottom: 15px;
        margin-top: -3px;
        padding: 0;
        position: relative;
        padding-bottom: 10px;
        border-bottom: none;
    }

    .uldiv p {
        margin-bottom: 10px !important;
    }

    .uldiv ul li {
        line-height: 30px;
        font-size: 13px;
        font-weight: 400;
        color: #777777;
    }
</style>

<?php
if (isset($_GET['type']) && $_GET['type'] == 'vendor') {
?>
    <!-- Start Terms & Condition page -->
    <section class="ec-page-content section-space-p terms_condition_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title py-3">
                        <h2 class="ec-title">Vendor Terms & Condition</h2>
                        <p class="sub-title mb-3">Welcome to the Discount Dhamaka marketplace</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ec-common-wrapper">
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Acceptance of Terms </h3>
                                <p>By using <a href="javascript:void(0);"><strong>https://www.discountdhamaka.com/</strong></a> (the “Website” )or <strong>“DiscountDhamaka”</strong> , the Mobile App, you (“you” or the “User”) unconditionally agree to the terms and conditions, without restriction, that we XXX Software Private Limited” have provided herein for use of this Website or Mobile App. If you do not wish to agree to the outlined terms and conditions (the “Terms of Use” or “Agreement”), please do not use this Website and/or Mobile App</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">General</h3>
                                <p><strong>“DiscountDhamaka”</strong> provides an interactive online service owned and operated by XXX Software Private Limited through the Website on the World Wide Web of the Internet (the “Web” or “Internet”) and android as well as ios Mobile App consisting of information services, content and transaction capabilities provided by XXX Software Private Limited its subsidiaries and its associates with whom it has business relationships (“Business Associates”) including but not limited to third parties that provide services in relation to creation, production or distribution of content for the Website (“Third Party Content Providers”), third parties that provide advertising services to DiscountDhamaka (“Third Party Advertisers”) and third parties that perform function on behalf of DiscountDhamaka like sending out and distributing our administrative and promotional emails and sms (“Third Party Service Providers”).</p>
                                <p> By registering or sharing your mobile no. on/with www.discountdhamaka.com,DiscountDhamaka Mobile App & DiscountDhamaka affiliates you explicitly agree to be contacted by our personnel via call/send you SMS’s related to our services, promotional offers, special deals, updates for new services and other items even if the contact number you have entered/shared is on DND (Do not Disturb).</p>
                                <p> The User by subscribing to the services provided by DiscountDhamaka, unconditionally agrees to be contacted by DiscountDhamaka or any of its merchants, affiliates, associates and / or assigns for regular updates relating to the services, status of their requests, new and / or promotional offers and other information, which DiscountDhamaka in its sole discretion may deem appropriate to send to the User(s) and the same in any manner will not be treated as breach of any privacy or rights of the User(s). Check out privacy policy for opt-out. This Agreement sets forth the terms and conditions that apply to the use of this Website by the User.</p>
                                <p> The right to use this Website is personal to User and is not transferable to any other person or entity. User shall be responsible for protecting the confidentiality of User’s password(s), if any. User understands and acknowledges that, although the Internet is often a secure environment, sometimes there are interruptions in service or events that are beyond the control of DiscountDhamaka, and DiscountDhamaka shall not be responsible for any data lost while transmitting information on the Internet.</p>
                                <p>While it is DiscountDhamaka’s objective to make the Website accessible at all times, the Website may be unavailable from time to time for any reason including, without limitation, routine maintenance. You understand and acknowledge that due to circumstances both within and outside of the control of DiscountDhamaka, access to the Website may be interrupted, suspended or terminated from time to time.</p>
                                <p>DiscountDhamaka reserves the right, in its sole discretion, to terminate the access to any or all DiscountDhamaka websites and the related services or any portion thereof at any time, without notice.</p>
                                <p>DiscountDhamaka shall have the right at any time to change or discontinue any aspect or feature of the Website, including, but not limited to, content, graphics, deals, offers, settings, hours of availability and equipment needed for access or use. Further, DiscountDhamaka may discontinue disseminating any portion of information or category of information, may change or eliminate any transmission method and may change transmission speeds or other signal characteristics.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Modified Terms</h3>
                                <p>DiscountDhamaka reserves the right at all times to discontinue or modify any of our Terms of Use and/or our Privacy Policy as we deem necessary or desirable without prior notification to you. Such changes may include, among other things, the adding of certain fees or charges. We suggest to you, therefore, that you re-read this important notice containing our Terms of Use and Privacy Policy from time to time in order that you stay informed as to any such changes. If we make changes to our Terms of Use and Privacy Policy and you continue to use our Website, you are implicitly agreeing to the amended Terms of Use and Privacy Policy. Unless specified otherwise, any such deletions or modifications shall be effective immediately upon DiscountDhamaka’s posting thereof. Any use of the Website by User after such notice shall be deemed to constitute acceptance by User of such modifications.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Equipment</h3>
                                <p>User shall be responsible for obtaining and maintaining all telephone, computer hardware and other equipment needed for access to and use of this Website and all charges related thereto. DiscountDhamaka shall not be liable for any damages to the User’s equipment resulting from the use of this Website.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Registration</h3>
                                <p>To utilize certain portions of the Website, you may be required to complete a registration process and establish an account with DiscountDhamaka website and/or Mobile App (“Account”). You represent and warrant that all information provided by you to DsicountDhamaka is current, accurate, and complete, and that you will maintain the accuracy and completeness of this information on a prompt, timely basis.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Password and Security</h3>
                                <p>As a registered user of the Websiteand/or Mobile App, you may receive or establish a user name and one or more passwords. You are solely responsible for maintaining the confidentiality and security of your password(s) and Account(s). You understand and agree that you are individually and fully responsible for all actions and postings made from your Account(s). Any accounts you create are not transferrable. You agree to notify DiscountDhamaka immediately if you become aware of any unauthorized use of your Account(s).</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">User Conduct</h3>
                                <p>This Website and any individual websites or merchant-specific, city-specific, or state-specific sites now or hereinafter contained within or otherwise available through external hyperlinks with our Website and/or Mobile App are private property. All interactions on this Website and/or Mobile App must comply with these Terms of Use. User shall not post or transmit through this Website and/or Mobile App any material which violates or infringes in any way upon the rights of others, or any material which is unlawful, threatening, abusive, defamatory, invasive of privacy or publicity rights, vulgar, obscene, profane or otherwise objectionable, which encourages conduct that would constitute a criminal offense, give rise to civil liability or otherwise violate any law, or which, without DiscountDhamaka’s express prior, written approval, contains advertising or any solicitation with respect to products or services. Any conduct by a User that in DiscountDhamaka’s exclusive discretion is in breach of the Terms of Use or which restricts or inhibits any other User from using or enjoying this Website and/or Mobile App is strictly prohibited. User shall not use this Website and/or Mobile App to advertise or perform any commercial, religious, political or non-commercial solicitation, including, but not limited to, the solicitation of users of this Website and/or Mobile App to become users of other online or offline services directly or indirectly competitive or potentially competitive with DiscountDhamaka.</p>
                                <p>The foregoing provisions of this Section 7 applies equally to and are for the benefit of DiscountDhamaka, its subsidiaries, Business Associates and Third Party Content Providers, and each shall have the right to assert and enforce such provisions directly or on its own behalf.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Purchase and Redemption of ‘DiscountDhamaka’ Deals</h3>
                                <p><strong>DiscountDhamaka</strong> provides an opportunity to its Users to avail value deals from a number of merchants, with which <strong>DiscountDhamaka</strong> has an association at discounted prices by issue of Deal Code that can be redeemed up to a certain validity period from outlets of the Institutions. In order to purchase <strong>DiscountDhamaka</strong> Deals, the User would be required to create an account on the Website. This is required so we can provide you with easy access to print your orders, view your past purchases and modify your preferences. By placing an order on the Website, you make an offer to us to purchase <strong>DiscountDhamaka</strong> Deals for buying / availing specific products and/or services which you have selected based on <strong>DiscountDhamaka</strong>´s standard terms and conditions, institution-specific restrictions and on these Terms of Use. All <strong>DiscountDhamaka</strong> Deals are promotional Deals and shall be subject to the Standard Terms and Conditions and Specific Terms and Conditions. <strong>DiscountDhamaka</strong> Deals are issued on behalf of the Institutions and only such Institutions, to the exclusion of <strong>DiscountDhamaka</strong>, shall be responsible for any and all injuries, illnesses, damages, charges, expenses, claims, liabilities and costs suffered by or in respect of a customer, caused in whole or in part by the Institutions or which arises out of the goods and/or services provided by the Institutions, as well as for any unclaimed property liability arising from unredeemed <strong>DiscountDhamaka</strong> Deals</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner uldiv">
                                <h3 class="ec-cms-block-title">Standard Terms and Conditions (for All DiscountDhamaka Deals).</h3>
                                <p>All Vendors shall be defined as an Institution that offers services as displayed on <strong>DiscountDhamaka</strong> website or Mobile App in its regular business operations, and is making such services available to purchasers of <strong>DiscountDhamaka</strong> Deals. In this respect, the following shall constitute as Standard Terms and Conditions for redeeming <strong>DiscountDhamaka</strong> Deals</p>
                                <ul>
                                    <li><i class="fa fa-check"></i> shall not be responsible for the quality of services provided by the Vendors, and the same shall be the sole responsibility of the Vendor.</li>
                                    <li><i class="fa fa-check"></i> No refunds shall be granted for DiscountDhamaka Deals.</li>
                                    <li><i class="fa fa-check"></i> Deals are redeemable in their entirety only and may not be redeemed incrementally.</li>
                                    <li><i class="fa fa-check"></i> Deals can be redeemed only after due verification of the customer including, without limitation, matching the unique identification number provided to the customer at the time of purchase of DiscountDhamaka Deals.</li>
                                    <li><i class="fa fa-check"></i> Validity period for redemption of DiscountDhamaka Deals is determined by Vendors, and shall be mentioned on DiscountDhamaka Deals.</li>
                                    <li><i class="fa fa-check"></i> Use of DiscountDhamaka Deals for alcoholic beverages is at the sole discretion of the Restaurant and is further subject to all applicable laws.</li>
                                    <li><i class="fa fa-check"></i> It is at the discretion of the Restaurant to determine whether DiscountDhamaka Deals can be combined with any other Restaurant Deals, third party Deals, Deals, or promotions and the like.</li>
                                    <li><i class="fa fa-check"></i> Deals cannot be used for taxes, tips or prior balances, unless permitted by the Vendor.</li>
                                    <li><i class="fa fa-check"></i> Deals are valid for the specific outlet as specified in the deal of a multi outlet brand unless otherwise stated.</li>
                                    <li><i class="fa fa-check"></i> The issuing of Deals and honouring of deals is at the sole discretion of the Vendor and DiscountDhamaka has no liability towards non honouring of deal however intimation of any such non honoring of deals cases be immediately intimated to DiscountDhamaka customer care for investigation and initiation of appropriate action against the vendor if required .</li>
                                    <li><i class="fa fa-check"></i> Reproduction, sale or trade of DiscountDhamaka Deals is strictly prohibited.</li>
                                    <li><i class="fa fa-check"></i> Any attempted redemption not consistent with these terms &amp; conditions will render the DiscountDhamaka Deal void and invalid.</li>
                                    <li><i class="fa fa-check"></i> The DiscountDhamaka Deal will expire on the date specified on it.</li>
                                    <li><i class="fa fa-check"></i> Limit of Two (2) Deals per vendor per customer is applicable. Only Two Deals per customer per vendor can be used unless otherwise specified by the Institution or DiscountDhamaka.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">User Generated Content</h3>
                                <p>The Website may allow for you to contribute and add value deals from a number of merchants. DiscountDhamaka reserves the right to include the value deal contributed by you to the Website or discard it, in its sole discretion.</p>
                                <p>DiscountDhamaka shall not have any obligation to pre-screen or regularly review all contributed content/ value deal. However, DiscountDhamaka has the absolute right (though not the obligation) to remove, without notice, any content / value deal posted.</p>
                                <p>By posting any content/ value deal, you represent and warrant (a) you have all right, title, and interest to such posted content/ value deal, including but not limited to any consent, authorization, release, clearance or license from any third party (such as, but not limited to, any release related to rights of privacy or publicity) necessary for you to provide, post, upload, input or submit the posted content, or (b) such posted content/ value deal is in the public domain, or (c) your use of such posted content/ value deal constitutes fair use. You further represent and warrant that posting such content/ value deal does not violate or constitute the infringement of any patent, copyright, trademark, trade secret, right of privacy, right of publicity, moral rights, or other intellectual property right recognized by any applicable jurisdiction of any person or entity, or otherwise constitute the breach of any agreement with any other person or entity.</p>
                                <p>You also agree not to post any of the following types of content to the Website: (a) adult content, pornography, explicit sexual images, or nude images; (b) content containing explicit, vulgar, or obscene language; (c) content promoting hate, abuse or destructive actions; (d) content promoting illegal activities; or primarily political, religious, psychic, or metaphysical content; (e) content promoting pirated software; (f) content intending for phishing or spreading malware; (g) content that is disparaging of any person or entity; (h) content that is in violation of any law or regulation; or (i) any other content that is or could be considered inappropriate, unsuitable or offensive, all as determined by us.</p>
                                <p>You shall be liable for any claims, damages or other demands arising due to any content/ value deal posted by you in violation of this clause and agree to indemnify DiscountDhamaka for any claims, damages or other demands arising due to any content/ value deal posted by you.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Copyright and Trademarks</h3>
                                <p>Everything located on or in this Website, including the Mobile App, is the exclusive property of DiscountDhamaka or used with express permission of the copyright and/or trademark owner. Any violation of this policy may result in a copyright, trademark or other intellectual property right infringement that may subject User to civil and / or criminal penalties.</p>
                                <p>This Website contains copyrighted material, trademarks and other proprietary information, including, but not limited to, text, software, photos, video, graphics, music, sound, and the entire contents of DiscountDhamaka protected by copyright as a collective work under the Indian copyright laws. DiscountDhamaka owns a copyright in the selection, coordination, arrangement and enhancement of such content, as well as in the content original to it.</p>
                                <p>User may not modify, publish, transmit, participate in the transfer or sale, create derivative works, or in any way exploit any of the content, in whole or in part. User may download / print / save copyrighted material for User’s personal use only. Except as otherwise expressly stated under copyright law, no copying, redistribution, retransmission, publication or commercial exploitation of downloaded material without the express permission of DiscountDhamaka and the copyright owner is permitted. If copying, redistribution or publication of copyrighted material is permitted, no changes in or deletion of author attribution, trademark legend or copyright notice shall be made. User acknowledges that he/she/it does not acquire any ownership rights by downloading copyrighted material. Trademarks that are located within or on the Website or a Web site otherwise owned or operated in conjunction with DiscountDhamaka or the Mobile App shall not be deemed to be in the public domain but rather the exclusive property of DiscountDhamaka, unless such site is under license from the Trademark owner thereof in which case such license is for the exclusive benefit and use of DiscountDhamaka, unless otherwise stated. User shall not upload, post or otherwise make available on this Website or Mobile App any material protected by copyright, trademark or other proprietary right without the express permission of the owner of the copyright, trademark or other proprietary right. DiscountDhamaka does not have any express burden or responsibility to provide User with indications, markings or anything else that may aid User in determining whether the material in question is copyrighted or trademarked. User shall be solely liable for any damage resulting from any infringement of copyrights, trademarks, proprietary rights or any other harm resulting from such a submission. By submitting material to any public area of this Website and/or Mobile App, User warrants that the owner of such material has expressly granted DiscountDhamaka the royalty-free, perpetual, irrevocable and non-exclusive right and license to use, reproduce, modify, adapt, publish, translate and distribute such material (in whole or in part) worldwide and/or to incorporate it in other works in any form, media or technology now known or hereafter developed for the full term of any copyright that may exist in such material. Users also permits any other User to access, view, store or reproduce the material for that User’s personal use. User hereby grants DiscountDhamaka the right to edit, copy, publish and distribute any material made available on this Website and/or Mobile App by User.</p>
                                <p>The foregoing provisions of Section 13 apply equally to and are for the benefit of DiscountDhamaka, its subsidiaries, Business Associates and Third Party Content Providers and each shall have the right to assert and enforce such provisions directly or on its own behalf.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Disclaimer of Warranty; Limitation of Liability</h3>
                                <p>User expressly agrees that use of this website and / or mobile app is at user’s sole risk. Neither discountdhamaka, its subsidiaries and business associates nor any of their respective employees, agents and third party content providers warrant that use of the website and/or mobile app will be uninterrupted or error free; nor do they make any warranty as to (i) the results that may be obtained from use of this website and/or mobile app or (ii) the accuracy, reliability or content of any information, service or merchandise provided through this website or the mobile app.</p>
                                <p>This website and the mobile app are made accessible on an “as is” basis without warranties of any kind, either express or implied, including, but not limited to, warranties of title or implied warranties of merchantability or fitness for a particular purpose, other than those warranties which are implied by and incapable of exclusion, restriction or modification under the laws applicable to this agreement.</p>
                                <p>This disclaimer of liability applies to any damages or injury caused by any failure of performance, error, omission, interruption, deletion, defect, delay in operation or transmission, computer virus, communication line failure, theft or destruction or unauthorized access to, alteration of, or use of record, whether for breach of contract, tortuous behavior, negligence, or under any other cause of action. User specifically acknowledges that discountdhamaka is not liable for the defamatory, offensive or illegal conduct of other users or third-parties and that the risk of injury from the foregoing rests entirely with user.</p>
                                <p>In no event shall discountdhamaka, or any person or entity involved in creating, producing or distributing this website and/or mobile app or the contents hereof, including any software, be liable for any damages, including, without limitation, direct, indirect, incidental, special, consequential or punitive damages arising out of the use of or inability to use this website and / or mobile app. User hereby acknowledges that the provisions of this section shall apply to all content on this site and the mobile app.</p>
                                <p>In addition to the terms set forth above, neither discountdhamaka, nor its subsidiaries and business associates, third party service providers or third party content providers shall be liable regardless of the cause or duration, for any errors, inaccuracies, omissions, or other defects in, or untimeliness or unauthenticity of, the information contained within this website and/or mobile app for any delay or interruption in the transmission thereof to the user, or for any claims or losses arising therefrom or occasioned thereby. None of the foregoing parties shall be liable for any third-party claims or losses of any nature, including without limitation lost profits, punitive or consequential damages.</p>
                                <p>Discountdhamaka is not responsible for any content that a user, subscriber, or an unauthorized user may post on this website and/ or mobile app any content that is posted or uploaded that is or may be deemed unsuitable can and may be taken down by discountdhamaka. Moreover, discountdhamaka reserves the right to edit, change, alter, delete and prohibit any and all content that it, discountdhamaka, deems unsuitable.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Monitoring</h3>
                                <p>DiscountDhamaka shall have the right, but not the obligation, to monitor the content of the Website at all times, including the comment section and any chat rooms and forums that may hereinafter be included as part of the Website and/ or Mobile App, to determine compliance with this Agreement and any operating rules established by DiscountDhamaka, as well as to satisfy any applicable law, regulation or authorized government request. Without limiting the foregoing, DiscountDhamaka shall have the right to remove any material that DiscountDhamaka, in its sole discretion, finds to be in violation of the provisions hereof or otherwise objectionable.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Privacy</h3>
                                <p>User acknowledges that all discussion for ratings, comments, bulletin board service, chat rooms and/or other message or communication facilities (collectively “Communities”) are public and not private communications, and that, therefore, others may read User’s communications without User’s knowledge. DiscountDhamaka does not control or endorse the content, messages or information found in any Community, and, therefore, DiscountDhamaka specifically disclaims any liability concerning the Communities and any actions resulting from User’s participation in any Community, including any objectionable content. Generally, any communication which User posts on the Website and/or Mobile App(whether in chat rooms, discussion groups,comments section, message boards or otherwise) is considered to be non-confidential. If particular web pages permit the submission of communications that will be treated by DiscountDhamaka as confidential, that fact will be stated on those pages. By posting comments, messages or other information on the Website, User grants DiscountDhamaka the right to use such comments, messages or information for promotions, advertising, market research or any other lawful purpose. For more information see DiscountDhamaka’s Privacy Policy.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">License Grant</h3>
                                <p>By posting content/ deals/ communications on or through this Website and/or Mobile App, User shall be deemed to have granted to DiscountDhamaka a royalty-free, perpetual, irrevocable & non-exclusive license to copy, transmit, use, reproduce, modify, publish, edit, translate, distribute, perform, display, reformat and incorporate it into a collective work the content/ value deals/ communication alone or as part of other works in any form, media, or technology whether now known or hereafter developed, and to sublicense such rights through multiple tiers of sublicensees. For greater certainty, this means that, among other things, DiscountDhamaka has the right to use any and all ideas you submit (including ideas about our products, services, publications or advertising campaigns) in any manner that we choose, without any notice or obligation to you whatsoever.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Indemnification</h3>
                                <p>User agrees to defend, indemnify and hold harmless DiscountDhamaka, its subsidiaries and Business Associates, and their respective directors, officers, employees and agents from and against all claims and expenses, including attorneys’ fees, arising out of the use of this Website and/or the Mobile App by User.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Termination</h3>
                                <p>DiscountDhamaka may terminate this Agreement at any time. Without limiting the foregoing, DiscountDhamaka shall have the right to immediately terminate any passwords or accounts of User in the event of any conduct by User which DiscountDhamaka, in its sole discretion, considers to be unacceptable, or in the event of any breach by User of this Agreement.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Trademarks</h3>
                                <p>DiscountDhamaka is a trademark of XXX. All rights in respect of this trademark are hereby expressly reserved. Unless otherwise indicated, all other trademarks appearing on the Website are the property of their respective owners.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Third Party Content</h3>
                                <p>DiscountDhamaka, similar to an Internet Service Provider, is a distributor (and not a publisher) of content supplied by third parties and Users. Accordingly, DiscountDhamaka has no more editorial control over such content than does a public library, bookstore or newsstand. Any opinions, advice, statements, services, offers, or other information or content expressed or made available by third parties, including information providers, or any other Users are those of the respective author(s) or distributors and not of DiscountDhamaka. Neither DiscountDhamaka nor any third-party provider of information guarantees the accuracy, completeness, or usefulness of any content, nor its merchantability or fitness for any particular purpose .</p>
                                <p>In many instances, the content available through this Website and/or Mobile App represents the opinions and judgments of the respective information provider, User, or other user not under contract with DiscountDhamaka. DiscountDhamaka neither endorses nor is responsible for the accuracy or reliability of any opinion, advice or statement made on the Website and/or Mobile App by anyone other than authorized DiscountDhamaka employee spokespersons while acting in official capacities.</p>
                                <p>Under no circumstances will DiscountDhamaka be liable for any loss or damage caused by User’s reliance on information obtained through the Website and/or Mobile App. It is the responsibility of User to evaluate the accuracy, completeness or usefulness of any information, opinion, advice etc. or other content available through the Website and/or Mobile App. The Website may contains links to third party Websites maintained by other content providers.</p>
                                <p>These links are provided solely as a convenience to you and not as an endorsement by DiscountDhamaka of the contents on such third-party sites and DiscountDhamaka hereby expressly disclaims any representations regarding the content or accuracy of materials on such third-party Web sites. If User decides to access linked third-party Web sites, User does so at own risk. Unless you have executed a written agreement with DiscountDhamaka expressly permitting you to do so, you may not provide a hyperlink to the Website from any other website. DiscountDhamaka reserves the right to revoke its consent to any link at any time in its sole discretion.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Force Majeure</h3>
                                <p>Without prejudice to any other provision herein, DiscountDhamaka shall not be liable for any loss, damage or penalty as a result of any delay in or failure to deliver or otherwise perform hereunder due to any cause beyond the DiscountDhamaka’s control, including, without limitation, acts of the User, embargo or other governmental act, regulation or request affecting the conduct of DiscountDhamaka’s business, fire, explosion, accident, theft, vandalism, riot, acts of war, strikes or other labour difficulties, lightning, flood, windstorm or other acts of God.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Miscellaneous</h3>
                                <p>This Agreement and any operating rules for the Website established by DiscountDhamaka constitute the entire agreement of the parties with respect to the subject matter hereof. No waiver by either party of any breach or default hereunder is a waiver of any preceding or subsequent breach or default. The section headings used herein are for convenience only and shall be of no legal force or effect. If any provision of this Agreement is held invalid by a court of competent jurisdiction, such invalidity shall not affect the enforceability of any other provisions contained in this Agreement and the remaining portions of this Agreement shall continue in full force and effect. The failure of either party to exercise any of its rights under this Agreement shall not be deemed a waiver or forfeiture of such rights or any other rights provided hereunder.</p>
                                <p>DiscountDhamaka’s headquarters are in Delhi, India. Legal issues arising out of, but not exclusive to the use of, this Website or the Mobile App (unless otherwise specifically stated) are governed by and in accordance with the laws of Delhi (exclusive of its rules regarding conflicts of laws).</p>
                                <p>Please read our privacy policy for data safety and other terms.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Terms & Condition page -->
<?php
} else {
?>
    <!-- Start Terms & Condition page -->
    <section class="ec-page-content section-space-p terms_condition_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title py-3">
                        <h2 class="ec-title">User Terms & Condition</h2>
                        <p class="sub-title mb-3">Welcome to the Discount Dhamaka marketplace</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ec-common-wrapper">
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <p>Welcome to <a href="www.discountdhamaka.com">www.discountdhamaka.com</a>, a website operated by Extrabucks Technologies Private Limited (“Extrabucks”, “we”, “us” or “our”). By using our website, you agree to be bound by these terms and conditions (“Terms”). Please read them carefully before accessing or using our website.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">1. Services</h3>
                                <p>Our website provides a platform for users (“you” or “your”) to browse, compare and purchase/avail deals, coupons, vouchers, gift cards and other products or services (“Deals”) offered by third-party merchants, vendors, advertisers or partners (“Merchants”). We do not sell, provide, deliver or endorse any Deals. We only act as an intermediary between you and the Merchants. When you purchase a Deal, you are entering into a contract with the Merchant, not with us. The Merchant is solely responsible for fulfilling the Deal, providing the goods or services, honoring the terms and conditions of the Deal, and handling any complaints, disputes or refunds.</p>

                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">2. Eligibility</h3>
                                <p>You must be at least 18 years old to use our website. By using our website, you represent and warrant that you have the legal capacity and authority to enter into these Terms and to comply with all applicable laws and regulations.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">3. Registration</h3>
                                <p>You may browse our website without registering an account. However, some features of our website may require you to register an account with us. When you register an account, you agree to provide accurate, current and complete information about yourself and to update your information as necessary. You are responsible for maintaining the confidentiality and security of your account and password. You agree not to share your account or password with anyone else. You also agree to notify us immediately of any unauthorized use of your account or password or any other breach of security. We are not liable for any loss or damage arising from your failure to protect your account or password.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">4. Purchases</h3>
                                <p>When you purchase a Deal through our website, you agree to pay the price and any applicable taxes and fees displayed on our website at the time of purchase. You also agree to the terms and conditions of the Deal as set forth by the Merchant. You acknowledge that the availability, quality, safety, legality, accuracy and suitability of the Deals are solely determined by the Merchants and not by us. We do not guarantee that the Deals will meet your expectations or requirements.
                                </p>
                                <p>
                                    You will receive a confirmation email from us after you complete your purchase. The confirmation email will contain a unique code or voucher that you can use to redeem the Deal from the Merchant. You must present the code or voucher to the Merchant before receiving the goods or services. The code or voucher is valid only for the specific Deal that you purchased and cannot be exchanged, transferred, resold or redeemed for cash. The code or voucher expires on the date specified on the confirmation email or on the Deal page, whichever is earlier. If you do not redeem the code or voucher before it expires, you will forfeit the Deal and no refund will be issued.
                                </p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">5. Refunds</h3>
                                <p>All sales are final and no refunds will be issued unless otherwise stated by the Merchant or required by law. If you have any issues with your purchase or with the Merchant, please contact the Merchant directly to resolve them. If you are unable to resolve your issues with the Merchant, please contact us at support@discountdhamaka.com and we will try to assist you.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">6. Intellectual Property</h3>
                                <p>We own or have the right to use all the content, design, layout, graphics, logos, trademarks and other intellectual property rights on our website (“Our Content”). Our Content is protected by copyright, trademark and other laws. You may not copy, modify, distribute, reproduce, display, perform, publish or create derivative works from Our Content without our prior written consent.</p>
                                <p>You may use our website for your personal and non-commercial use only. You may not use our website for any illegal, fraudulent or harmful purpose or activity. You may not interfere with or disrupt the operation of our website or violate any security features of our website.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">7. User Content</h3>
                                <p>You may post, upload, submit or share comments, reviews, feedbacks, ratings, suggestions or other content on our website (“User Content”). You are solely responsible for your User Content and the consequences of posting or sharing it. You represent and warrant that you own or have the necessary rights and permissions to use and share your User Content and that your User Content does not infringe any intellectual property rights, privacy rights, publicity rights or other rights of any third party.</p>
                                <p>By posting or sharing your User Content on our website, you grant us a non-exclusive, royalty-free, perpetual, irrevocable, worldwide, sub-licensable and transferable license to use, copy, modify, distribute, reproduce, display, perform, publish and create derivative works from your User Content for any purpose and in any media, without any compensation or obligation to you.</p>
                                <p>You also grant us the right to use your name, username, profile picture and other information that you provide or display on our website in connection with your User Content.</p>
                                <p>You agree not to post or share any User Content that is unlawful, harmful, abusive, harassing, defamatory, libelous, slanderous, obscene, vulgar, pornographic, hateful, discriminatory, threatening, invasive of privacy or publicity rights, or otherwise objectionable. You also agree not to post or share any User Content that contains any personal information of any third party without their consent, or that violates any applicable laws or regulations.</p>
                                <p>We reserve the right to review, edit, remove or disable access to any User Content at our sole discretion and without notice. We do not endorse or guarantee the accuracy, reliability, quality or suitability of any User Content. We are not liable for any loss or damage arising from your reliance on any User Content.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner uldiv">
                                <h3 class="ec-cms-block-title">Third-Party Links</h3>
                                <p>Our website may contain links to other websites operated by third parties (“Third-Party Websites”). These links are provided for your convenience and reference only. We do not control, endorse or assume any responsibility for the content, products, services, policies or practices of any Third-Party Websites. You access and use any Third-Party Websites at your own risk and discretion. You should review the terms and conditions and privacy policies of any Third-Party Websites before using them.</p>

                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">8. User Generated Content</h3>
                                <p>The Website may allow for you to contribute and add value deals from a number of merchants. DiscountDhamaka reserves the right to include the value deal contributed by you to the Website or discard it, in its sole discretion.</p>
                                <p>DiscountDhamaka shall not have any obligation to pre-screen or regularly review all contributed content/ value deal. However, DiscountDhamaka has the absolute right (though not the obligation) to remove, without notice, any content / value deal posted.</p>
                                <p>By posting any content/ value deal, you represent and warrant (a) you have all right, title, and interest to such posted content/ value deal, including but not limited to any consent, authorization, release, clearance or license from any third party (such as, but not limited to, any release related to rights of privacy or publicity) necessary for you to provide, post, upload, input or submit the posted content, or (b) such posted content/ value deal is in the public domain, or (c) your use of such posted content/ value deal constitutes fair use. You further represent and warrant that posting such content/ value deal does not violate or constitute the infringement of any patent, copyright, trademark, trade secret, right of privacy, right of publicity, moral rights, or other intellectual property right recognized by any applicable jurisdiction of any person or entity, or otherwise constitute the breach of any agreement with any other person or entity.</p>
                                <p>You also agree not to post any of the following types of content to the Website: (a) adult content, pornography, explicit sexual images, or nude images; (b) content containing explicit, vulgar, or obscene language; (c) content promoting hate, abuse or destructive actions; (d) content promoting illegal activities; or primarily political, religious, psychic, or metaphysical content; (e) content promoting pirated software; (f) content intending for phishing or spreading malware; (g) content that is disparaging of any person or entity; (h) content that is in violation of any law or regulation; or (i) any other content that is or could be considered inappropriate, unsuitable or offensive, all as determined by us.</p>
                                <p>You shall be liable for any claims, damages or other demands arising due to any content/ value deal posted by you in violation of this clause and agree to indemnify DiscountDhamaka for any claims, damages or other demands arising due to any content/ value deal posted by you.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">9. Disclaimer of Warranties</h3>
                                <p>Our website and all the content, products and services provided through it are provided on an “as is” and “as available” basis without any warranties of any kind. To the fullest extent permitted by law, we disclaim all warranties, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose, title and non-infringement. We do not warrant that our website will be uninterrupted, error-free, secure or free of viruses or other harmful components. We do not warrant the accuracy, completeness, reliability or timeliness of any information, content, products or services provided through our website. We do not warrant that any defects or errors will be corrected. We do not warrant that your use of our website will meet your expectations or requirements.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">10. Limitation of Liability</h3>
                                <p>To the fullest extent permitted by law, we and our affiliates, directors, officers, employees, agents and contractors will not be liable for any direct, indirect, incidental, special, consequential or exemplary damages arising from or in connection with your use of or inability to use our website or any content, products or services provided through it, including but not limited to loss of profits, revenue, data, goodwill or other intangible losses, even if we have been advised of the possibility of such damages.</p>
                                <p>In no event will our total liability to you for all claims arising from or in connection with your use of or inability to use our website or any content, products or services provided through it exceed the amount paid by you to us for the purchase of the Deal in question or Rupees one hundred only ( Rs.100), whichever is less.</p>
                                <p>Some jurisdictions do not allow the exclusion or limitation of certain warranties or liabilities, so some of the above exclusions or limitations may not apply to you. You may have other rights that vary from jurisdiction to jurisdiction.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">11. Indemnification</h3>
                                <p>You agree to indemnify, defend and hold harmless us and our affiliates, directors, officers, employees, agents and contractors from and against any and all claims, liabilities, damages, losses, costs and expenses (including reasonable attorney’s fees) arising from or in connection with your use of or inability to use our website or any content, products or services provided through it; your violation of these Terms; your violation of any rights of any third party; or your User Content.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">12. Termination</h3>
                                <p>We reserve the right to terminate your access to and use of our website at any time and for any reason without notice. We also reserve the right to modify, suspend or discontinue our website or any part thereof at any time and for any reason without notice. We are not liable for any loss or damage arising from such termination, modification, suspension or discontinuation. These Terms will survive the termination of your access to and use of our website.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">13. Changes</h3>
                                <p>We may change these Terms at any time and for any reason by posting the updated Terms on our website. You should review these Terms periodically for changes. Your continued use of our website after we post the updated Terms constitutes your acceptance of the changes.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">14. Governing Law</h3>
                                <p>These Terms are governed by and construed in accordance with the laws of India.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">15. Dispute Resolution</h3>
                                <p>Any dispute, controversy or claim arising from or in connection with these Terms or your use of or inability to use our website or any content, products or services provided through it will be resolved by arbitration in accordance with the Arbitration and Conciliation Act, 1996. The arbitration will be conducted by a sole arbitrator appointed by us. The arbitration will be held in New Delhi, India and the language of arbitration will be English. The award of the arbitrator will be final and binding on both parties. You agree to waive any right to appeal or challenge the arbitrator’s decision or award. All disputes shall be subject to Delhi Jurisdiction only.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">16. Severability</h3>
                                <p>If any provision of these Terms is found to be invalid, illegal or unenforceable by any court or tribunal of competent jurisdiction, such provision will be severed from these Terms and the remaining provisions will continue in full force and effect.</p>
                            </div>
                        </div>

                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">17. Waiver</h3>
                                <p>No failure or delay by us in exercising any right, power or remedy under these Terms will constitute a waiver of such right, power or remedy. No waiver by us of any breach of these Terms by you will constitute a waiver of any subsequent or other breach of these Terms by you.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">18. Assignment</h3>
                                <p>You may not assign, transfer or delegate any of your rights or obligations under these Terms without our prior written consent. We may assign, transfer or delegate any of our rights or obligations under these Terms without your consent.</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">19. Entire Agreement</h3>
                                <p>These Terms constitute the entire agreement between you and us regarding your use of and access to our website and supersede all prior and contemporaneous agreements, understandings and communications, whether written or oral, between you and us regarding the same subject matter.</p>

                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">20. Contact Us</h3>
                                <p>If you have any questions, comments or concerns about these Terms or our website, please contact us at support@discountdhamaka.com. We will try to respond to you as soon as possible</p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Terms & Condition page -->
<?php
}
?>




<!-- footer start here -->
<?php include('includes/footer.php'); ?>