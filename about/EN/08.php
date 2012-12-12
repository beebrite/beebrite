<?php

if(isset($_GET['a'])){
	$legalarea = $_GET['a'];
}else{
	$legalarea = 1;
};

?>

<style>
.legalspacer { float: left; width: 20px; height: 51px; border-bottom: solid 1px #E1E1E1; }
.legalbuttonon { float:left; height: 50px; text-align: center; line-height: 50px; background-color: #FFFFFF; width:313px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#505050; margin: 0px -1px 20px 0px; cursor: default; border: 1px solid #E1E1E1; border-bottom: none; }
.legalbuttonoff { float:left; height: 50px; text-align: center; line-height: 50px; background-color: #F0F0F0; width:313px; font-family:'myriad-pro'; font-weight:300; font-style:normal; font-size:20px; color:#505050; margin: 0px -1px 20px 0px; cursor: pointer; border: 1px solid #E1E1E1; box-shadow: inset 0px 0px 1px 1px #FFFFFF; }
.legalcontent p { margin: 10px; }
</style>

<script>

var legalactive = <?php echo $legalarea; ?>;

function changeterms(terms){
	if(legalactive != terms){
		$('#legalserviceterms').toggle();
		$('#legalprivacypolitics').toggle();
		$('#legalbuttonterms').toggleClass('legalbuttonoff');
		$('#legalbuttonprivacy').toggleClass('legalbuttonoff');
		legalactive = terms;
	};
};

</script>

<div class="legalspacer"></div>
<div id="legalbuttonterms" class="legalbuttonon <?php if($legalarea == 2){ echo 'legalbuttonoff';} ?>" onclick="changeterms(1);">Terms of Service</div>
<div id="legalbuttonprivacy" class="legalbuttonon <?php if($legalarea == 1){ echo 'legalbuttonoff';} ?>" onclick="changeterms(2);">Privacy Policy</div>
<div class="legalspacer"></div>
<br style="clear:both" />

<div id="legalserviceterms" class="legalcontent" <?php if($legalarea == 2){ echo 'style="display:none;"';} ?>>

<h1>Beebrite Terms of Service
</h1>
<p>By using the Beebrite.com web site ("Service"), or any services of Beebrite SL ("Beebrite"), you are agreeing to be bound by the following terms and conditions ("Terms of Service"). IF YOU ARE ENTERING INTO THIS AGREEMENT ON BEHALF OF A COMPANY OR OTHER LEGAL ENTITY, YOU REPRESENT THAT YOU HAVE THE AUTHORITY TO BIND SUCH ENTITY, ITS AFFILIATES AND ALL USERS WHO ACCESS OUR SERVICES THROUGH YOUR ACCOUNT TO THESE TERMS AND CONDITIONS, IN WHICH CASE THE TERMS "YOU" OR "YOUR" SHALL REFER TO SUCH ENTITY, ITS AFFILIATES AND USERS ASSOCIATED WITH IT. IF YOU DO NOT HAVE SUCH AUTHORITY, OR IF YOU DO NOT AGREE WITH THESE TERMS AND CONDITIONS, YOU MUST NOT ACCEPT THIS AGREEMENT AND MAY NOT USE THE SERVICES.
</p>
<p>Beebrite reserves the right to update and change the Terms of Service from time to time without notice. Any new features that augment or enhance the current Service, including the release of new tools and resources, shall be subject to the Terms of Service. Continued use of the Service after any such changes shall constitute your consent to such changes. You can review the most current version of the Terms of Service at any time at: http://www.beebrite.com/terms-of-service/
</p>
<p>Violation of any of the terms below will result in the termination of your Account. While Beebrite prohibits such conduct and Content on the Service, you understand and agree that Beebrite cannot be responsible for the Content posted on the Service and you nonetheless may be exposed to such materials. You agree to use the Service at your own risk.
</p>

<h2>A. Account Terms
</h2>
<p>1.	You must be 13 years or older to use this Service.
</p>
<p>2.	You must be a human. Accounts registered by "bots" or other automated methods are not permitted.
</p>
<p>3.	You must provide your legal full name, a valid email address, and any other information requested in order to complete the signup process.
</p>
<p>4.	Your login may only be used by one person - a single login shared by multiple people is not permitted. You may create separate logins for as many people as your plan allows.
</p>
<p>5.	You are responsible for maintaining the security of your account and password. Beebrite cannot and will not be liable for any loss or damage from your failure to comply with this security obligation.
</p>
<p>6.	You are responsible for all Content posted and activity that occurs under your account (even when Content is posted by others who have accounts under your account).
</p>
<p>7.	One person or legal entity may not maintain more than one free account.
</p>
<p>8.	You may not use the Service for any illegal or unauthorized purpose. You must not, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright or trademark laws).
</p>

<h2>B. Payment, Refunds, Upgrading and Downgrading Terms
</h2>
<p>1.	All paid plans must enter a valid credit card. Free accounts are not required to provide a credit card number.
</p>
<p>2.	An upgrade from the free plan to the Premium plan will immediately bill you.
</p>
<p>3.	The Service is billed in advance on a monthly basis and is non-refundable. There will be no refunds or credits for partial months of service, upgrade/downgrade refunds, or refunds for months unused with an open account. In order to treat everyone equally, no exceptions will be made. As it is deemed that the Subscriber has the opportunity to thoroughly evaluate the Service during the free trial period, subsequently purchased subscriptions are not refundable.
</p>
<p>4.	All fees are exclusive of all taxes, levies, or duties imposed by taxing authorities, and you shall be responsible for payment of all such taxes, levies, or duties, including VAT and/or equivalent sales tax.
</p>
<p>5.	For any upgrade or downgrade in plan level, your credit card that you provided will automatically be charged the new rate on your next billing cycle.
</p>
<p>6.	Downgrading your Service may cause the loss of Content, features, or capacity of your Account. Beebrite does not accept any liability for such loss.
</p>

<h2>C. 30-Days Free Trial Terms and Conditions
</h2>
<p>This offer (the “30-Days Free Trial Offer”), which is made to you by Beebrite, entitles you access to the Beebrite Premium Service for a period of thirty (30) days from the moment that you activate such trial period by submitting your payment details (the “Free Trial Period”).
</p>
<p>By submitting your payment details, you accept the New 30-Days Free Trial Offer and (i) consent to us using your payment details in accordance with our Privacy Policy, (ii) acknowledge and agree to Beebrite Terms of Service and these Beebrite Premium Service General Free Trial Terms and Conditions. If you decide that you do not want to become a paying user of the Beebrite Premium Service upon the lapse of the Free Trial Period, you have to terminate your Premium Service (visit “Settings”, and “Membership” on your Beebrite site) by the end of the Free Trial Period. You may only use this Free Trial Offer once. Beebrite reserves the right, in its absolute discretion, to withdraw or to modify this Free Trial Offer and/or the Beebrite New 30-Days Free Trial Terms and Conditions at any time without prior notice and with no liability.
</p>


<h2>D. Cancellation and Termination
</h2>
<p>1.	You are solely responsible for properly canceling your account. An email or phone request to cancel your account is not considered cancellation. You can cancel your account at any time by clicking on the Settings menu, and clicking on Membership link. 
</p>
<p>2.	All of your Content will be immediately deleted from the Service upon cancellation. This information can not be recovered once your account is cancelled.
</p>
<p>3.	If you cancel the Service before the end of your current paid up month, your cancellation will take effect immediately and you will not be charged again.
</p>
<p>4.	Beebrite, in its sole discretion, has the right to suspend or terminate your account and refuse any and all current or future use of the Service, or any other Beebrite service, for any reason at any time. Such termination of the Service will result in the deactivation or deletion of your Account or your access to your Account, and the forfeiture and relinquishment of all Content in your Account. Beebrite reserves the right to refuse service to anyone for any reason at any time.
</p>


<h2>E. Modifications to the Service and Prices
</h2>
<p>1.	Beebrite reserves the right at any time and from time to time to modify or discontinue, temporarily or permanently, the Service (or any part thereof) with or without notice.
</p>
<p>2.	Prices of all Services, including but not limited to monthly subscription plan fees to the Service, are subject to change upon 30 days notice from us. Such notice may be provided at any time by posting the changes to the Beebrite Site (beebrite.com) or the Service itself.
</p>
<p>3.	Beebrite shall not be liable to you or to any third party for any modification, price change, suspension or discontinuance of the Service.
</p>

<h2>F. Copyright and Content Ownership
</h2>
<p>1.	We claim no intellectual property rights over the material you provide to the Service. Your profile and materials uploaded remain yours. However, by setting your pages to be viewed publicly, you agree to allow others to view your Content. By setting your repositories to be viewed publicly, you agree to allow others to view and fork your repositories.
</p>
<p>2.	Beebrite does not pre-screen Content, but Beebrite and its designee have the right (but not the obligation) in their sole discretion to refuse or remove any Content that is available via the Service.
</p>
<p>3.	You shall defend Beebrite against any claim, demand, suit or proceeding made or brought against Beebrite by a third party alleging that Your Content, or Your use of the Service in violation of this Agreement, infringes or misappropriates the intellectual property rights of a third party or violates applicable law, and shall indemnify Beebrite for any damages finally awarded against, and for reasonable attorney’s fees incurred by, Beebrite in connection with any such claim, demand, suit or proceeding; provided, that Beebrite (a) promptly gives You written notice of the claim, demand, suit or proceeding; (b) gives You sole control of the defense and settlement of the claim, demand, suit or proceeding (provided that You may not settle any claim, demand, suit or proceeding unless the settlement unconditionally releases Beebrite of all liability); and (c) provides to You all reasonable assistance, at Your expense.
</p>
<p>4.	The look and feel of the Service is copyright ©2012 Beebrite S.L. All rights reserved. You may not duplicate, copy, or reuse any portion of the HTML/CSS, Javascript, or visual design elements or concepts without express written permission from Beebrite.
</p>

<h2>G. General Conditions
</h2>
<p>1.	Your use of the Service is at your sole risk. The service is provided on an "as is" and "as available" basis.
</p>
<p>2.	Technical support is only provided to paying account holders and is only available via email. Support is available in English and Spanish.
</p>
<p>3.	You understand that Beebrite uses third party vendors and hosting partners to provide the necessary hardware, software, networking, storage, and related technology required to run the Service.
</p>
<p>4.	You must not modify, adapt or hack the Service or modify another website so as to falsely imply that it is associated with the Service, Beebrite, or any other Beebrite service.
</p>
<p>5.	You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service without the express written permission by Beebrite.
</p>
<p>6.	We may, but have no obligation to, remove Content and Accounts containing Content that we determine in our sole discretion are unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or violates any party's intellectual property or these Terms of Service.
</p>
<p>7.	Verbal, physical, written or other abuse (including threats of abuse or retribution) of any Beebrite customer, employee, member, or officer will result in immediate account termination.
</p>
<p>8.	You understand that the technical processing and transmission of the Service, including your Content, may be transfered unencrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices.
</p>
<p>9.	Beebrite does not warrant that (i) the service will meet your specific requirements, (ii) the service will be uninterrupted, timely, secure, or error-free, (iii) the results that may be obtained from the use of the service will be accurate or reliable, (iv) the quality of any products, services, information, or other material purchased or obtained by you through the service will meet your expectations, and (v) any errors in the Service will be corrected.
</p>
<p>10.	You expressly understand and agree that Beebrite shall not be liable for any direct, indirect, incidental, special, consequential or exemplary damages, including but not limited to, damages for loss of profits, goodwill, use, data or other intangible losses (even if Beebrite has been advised of the possibility of such damages), resulting from: (i) the use or the inability to use the service; (ii) the cost of procurement of substitute goods and services resulting from any goods, data, information or services purchased or obtained or messages received or transactions entered into through or from the service; (iii) unauthorized access to or alteration of your transmissions or data; (iv) statements or conduct of any third party on the service; (v) or any other matter relating to the service.
</p>
<p>11.	The failure of Beebrite to exercise or enforce any right or provision of the Terms of Service shall not constitute a waiver of such right or provision. The Terms of Service constitutes the entire agreement between you and Beebrite and govern your use of the Service, superseding any prior agreements between you and Beebrite (including, but not limited to, any prior versions of the Terms of Service). You agree that these Terms of Service and Your use of the Service are governed under Madrid (Spain) law.
</p>
<p>12.	Questions about the Terms of Service should be sent to support@beebrite.com.
The Service is operated and provided by Beebrite S.L., Paseo del Club Deportivo, 1, Edif.15A, Pozuelo de Alarcón, 28223, Madrid, Spain. Phone +34 912 97 97 39.
</p>


<h5>Version: October 2012
</h5>

</div>

<div id="legalprivacypolitics" class="legalcontent" <?php if($legalarea == 1){ echo 'style="display:none;"';} ?>>

<h1>Beebrite Privacy Policy
</h1>

<p>Beebrite SL is a Spanish Corporation, with corporate address in Paseo del Club Deportivo, 1, Blq15A, CP 28223, Pozuelo de Alarcon,Madrid, Spain. 
</p>
<p>We take your Privacy very seriously. This Privacy Policy applies to the Site www.beebrite.com. 
</p>

<h2>Signing up via Facebook Connect 
</h2>
<p>Beebrite’s applications belong to Beebrite SL and, although they are integrated into the Facebook’s social platform, Facebook Inc. and Beebrite SL are different and independent companies. 
</p>
<p>By signing up in an application developed and maintained by Beebrite SL via Facebook connect, you accept the Facebook’s privacy policy, which is strictly complied by Beebrite SL. (http://developers.facebook.com/policy/) 
</p>
<p>Personal data obtained from Facebook will be treated exactly as if you had provided us with them via our sign up form, so you can expect the more strict security measures to be applied to your information. 
</p>

<h2>General Information
</h2>
<p>We collect the e-mail addresses of those who communicate with us via e-mail, aggregate information on what pages consumers access or visit, and information volunteered by the consumer (such as survey information and/or site registrations). The information we collect is used to improve the content of our Web pages and the quality of our service, and is not shared with or sold to other organizations for commercial purposes, except to provide products or services you've requested, when we have your permission, or under the following circumstances:
</p>
<p>•	It is necessary to share information in order to investigate, prevent, or take action regarding illegal activities, suspected fraud, situations involving potential threats to the physical safety of any person, violations of Terms of Service, or as otherwise required by law.
</p>
<p>•	We transfer information about you if Beebrite is acquired by or merged with another company. In this event, Beebrite will notify you before information about you is transferred and becomes subject to a different privacy policy.
</p>

<h2>Information Gathering and Usage
</h2>
<p>When you register for Beebrite we ask for information such as your name, email address, billing address, credit card information. Members who sign up for the free account are not required to enter a credit card.
</p>
<p>Beebrite uses collected information for the following general purposes: products and services provision, billing, identification and authentication, services improvement, contact, and research.
</p>

<h2>Cookies
</h2>
<p>•	A cookie is a small amount of data, which often includes an anonymous unique identifier, that is sent to your browser from a web site's computers and stored on your computer's hard drive.
</p>
<p>•	Cookies are required to use the Beebrite service.
</p>
<p>•	We use cookies to record current session information, but do not use permanent cookies. You are required to re-login to your Beebrite account after a certain period of time has elapsed to protect you against others accidentally accessing your account contents.
</p>


<h2>Data Storage
</h2>
<p>Beebrite uses third party vendors and hosting partners to provide the necessary hardware, software, networking, storage, and related technology required to run Beebrite. Although Beebrite owns the code, databases, and all rights to the Beebrite application, you retain all rights to your data.
</p>

<h2>Disclosure
</h2>
<p>Beebrite may disclose personally identifiable information under special circumstances, such as to comply with subpoenas or when your actions violate the Terms of Service.
</p>

<h2>Changes
</h2>
<p>Beebrite may periodically update this policy. We will notify you about significant changes in the way we treat personal information by sending a notice to the primary email address specified in your Beebrite primary account holder account or by placing a prominent notice on our site.
</p>

<h2>Questions
</h2>
<p>Any questions about this Privacy Policy should be addressed to support@beebrite.com.
</p>


<h5>Version: October 2012
</h5>

</div>