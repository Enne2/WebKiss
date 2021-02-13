# WebKiss
HTML Static Page Generator and CMS implementing a totally KISS and universal logic for languagenative and hackable developing
---
Be honest,you've some experience with HTML, CSS, PHP and frontend JavaScript, and sometime someone ask you to make his promtional site. You think it could be a near static one, with few information and some preprocessor generated content. Now you can write the static frontend site and hard-code in in it data and php code. This is ok for a few times after launch, but now informations and routines in your page have to be updated and edited. Your ideas behind this work are totally wrong: the guy who asked the website cannot change anything without your programming skills. Maybe a CMS or a Framework are a solution. Yes, they are. However something like WordPress or Drupal are gigantic overrkills for your simple, near-sttic web site. They need a strong server environment, mantenance, training to develop and to understand how to edit. They are made for non-programmers and are stupidly hard to costumize if you go beyond what CMS developers wanted you could do. Frameworks are a good choise, but you need to learn how to use them, they use a strong abstraction from the barebone languages, they change quickly and there are millions of them!
But you need to make simply a near-static website!
So this essential CMS-code generator is a simple, begineer friendly solution. Read this use case and find if it could be useful for you.
- Someone asked you to make a site with few page and contents need to be updated from the user (but not impagination) in the future. 
- No new page will be added directly from the user.
- Contents of page will not be generated from the PHP everytime is requested, but only when editing is made.

 There is the idea behind the implementation:
 
 1. Frontend are aleady made and standalone, I cconvert the in templates using a template engine adding placeholder for editable variables.
 2. I create a YAML content where add static variables definitions and values.
 3. This variables could be lnked to markdown files (they will be converted in HTML on compling). I can edit that file to inject HTML content in the page.
 4. A PHP script can be added and execute to this recipe for generate more variables.
 5. After doing this a html document is generated and saved in a folder to be published
 
 In other words we have a fronted template with variable placeholders, we load a yaml with definition of static variables and generation of html variabes from markdown files, whe execute a php script t generate some other variables. Put it all toghether and output a static web page.
 The user will have a frontend wysiwg editor to edit markdown files and a code editor for yaml files.
 Simple.
 Kisses.
 
