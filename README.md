# eBay HTML Generator  
<small>Just a simple web application built using CodeIgniter, jQuery, and MySQL which allows users to create custom embedable HTML layouts for eBay listings.</small>

### User Accounts
<small> Users are allowed to create their own accounts to access a dashboard which allows them to save and manage templates. In practice you're likely going to want to harden the 'password reset' conditions, and select/impliment an appropriate sorting algorithm for account lookups.</small>

### Newsletter Functionality
<small> To skip a download delay the user has the option to sign-up for a newsletter. Presently its a one-time use type of deal, and the functionality is limited to creating a table of e-mails. Which can be exported to work with Aweber, MailChimp, or whatever your favorite e-mail marketing service happens to be.</small>

### Preview
<small> After users input the data in the editor they're allowed to load up a preview. Where they can preview the look-and-feel as well modify the color used on the template.</small>

### eBay Templates
<small> Presently there's only one template available, and to be completely honest it could be quite a bit better. Namely in that it should be made to use a 'fluid layout' as opposed to a 'fixed layout'. Which isn't fully compatible with eBay's container.</small>

<small> Any additional templates you create must follow the structured laid out in the 'temp_template' multi-dimensional array.</small>

### Contact Form
<small> Because this is very much reliant on your SMTP configuration the functionality is incomplete, but all the necessary compontents are there to hook it up. For example, </small>
<pre>
                    $ci = get_instance();
                    $ci->load->library('email');
                    $config['protocol'] = "smtp";
                    $config['smtp_host'] = "ssl://smtp.gmail.com";
                    $config['smtp_port'] = "465";
                    $config['smtp_user'] = "your.account@gmail.com";
                    $config['smtp_pass'] = "password";
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['newline'] = "\r\n";
                    $ci->email->initialize($config);

                    $ci->email->from($user_email, $user_name);
                    $ci->email->to('your.account@gmail.com');
                    $ci->email->subject($user_subject);
                    $ci->email->message($user_message);
                    $ci->email->send();
</pre>
<small> This snipped when added to the 'contact controller' will work with some server configurations but not others. </small>
