<?PHP
require_once("./includes/contact_form-lib.php");
$formmailobj =  new FormMail("contact_form");
$formmailobj->setFormPage(sfm_readfile("./templ/contact_form_form_page.txt"));
$formmailobj->setFormID("1a19adf5-c740-4350-a669-0798f5d8700d");
$formmailobj->setFormKey("c8975f57-ab98-45e8-9c42-23d937073759");
$formmailobj->setEmailFormatHTML(true);
$formmailobj->EnableLogging(false);
$formmailobj->SetDebugMode(false);
$formmailobj->SetFromAddress("Sara Williams<swnovelist@gmail.com>");
$formmailobj->SetCommonDateFormat("m-d-Y");
$formmailobj->SetSingleBoxErrorDisplay(true);
$fm_installer =  new FM_FormInstaller();
$formmailobj->addModule($fm_installer);

$formmailobj->setIsInstalled(true);
$formmailobj->setFormFileFolder("./formdata");
$formfiller =  new FM_FormFillerScriptWriter();
$formmailobj->addModule($formfiller);

$formmailobj->AddElementInfo("Name","text");
$formmailobj->AddElementInfo("Email","text");
$formmailobj->AddElementInfo("Message","multiline");
$page_renderer =  new FM_FormPageRenderer();
$formmailobj->addModule($page_renderer);

$validator =  new FM_FormValidator();
$validator->addValidation("Email","req","Please fill in Email");
$formmailobj->addModule($validator);

$data_email_sender =  new FM_FormDataSender(sfm_readfile("./templ/contact_form_email_subj.txt"),sfm_readfile("./templ/contact_form_email_body.txt"),"%Email%");
$data_email_sender->AddToAddr("Farhad Hanjan<swnovelist@gmail.com>");
$formmailobj->addModule($data_email_sender);

$autoresp =  new FM_AutoResponseSender(sfm_readfile("./templ/contact_form_resp_subj.txt"),sfm_readfile("./templ/contact_form_resp_body.txt"));
$autoresp->SetToVariables("Name","Email");
$formmailobj->addModule($autoresp);

$csv_maker =  new FM_FormDataCSVMaker(1024);
$csv_maker->AddCSVVariable(array("Name","Email","Message","_sfm_form_submision_time_","_sfm_visitor_ip_"));
$formmailobj->addModule($csv_maker);

$tupage =  new FM_ThankYouPage(sfm_readfile("./templ/contact_form_thank_u.txt"));
$formmailobj->addModule($tupage);

$fm_installer->SetCSVMaker($csv_maker);
$formmailobj->ProcessForm();

?>