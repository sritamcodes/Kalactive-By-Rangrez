<?php
/*
|--------------------------------------------------------------------------
| कला'ctive - HELP DESK
|--------------------------------------------------------------------------
| File: help.php
|
| Public page:
|   - Help Desk
|   - FAQs
|   - Contact / Support Request
|   - Terms & Conditions
|
| IMPORTANT:
| Replace the database section below with your existing database
| connection if your project already has one.
|--------------------------------------------------------------------------
*/

session_start();

/*
|--------------------------------------------------------------------------
| OPTIONAL DATABASE CONNECTION
|--------------------------------------------------------------------------
|
| If your project already has a database connection file, uncomment
| the appropriate include below and adjust the filename.
|
| Example:
| require_once 'config.php';
|
| Do NOT create a second database connection if your project already
| has one.
|
|--------------------------------------------------------------------------
*/

// require_once 'config.php';


/*
|--------------------------------------------------------------------------
| FORM HANDLING
|--------------------------------------------------------------------------
*/

$success_message = '';
$error_message = '';

$form_name = '';
$form_email = '';
$form_order = '';
$form_subject = '';
$form_category = '';
$form_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form_name = trim($_POST['name'] ?? '');
    $form_email = trim($_POST['email'] ?? '');
    $form_order = trim($_POST['order_number'] ?? '');
    $form_subject = trim($_POST['subject'] ?? '');
    $form_category = trim($_POST['category'] ?? '');
    $form_message = trim($_POST['message'] ?? '');

    // Basic validation
    if ($form_name === '') {
        $error_message = 'Please enter your name.';
    } elseif (!filter_var($form_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } elseif ($form_subject === '') {
        $error_message = 'Please enter a subject.';
    } elseif ($form_category === '') {
        $error_message = 'Please select a category.';
    } elseif ($form_message === '') {
        $error_message = 'Please enter your message.';
    } elseif (strlen($form_message) > 5000) {
        $error_message = 'Your message is too long.';
    } else {

        /*
        |--------------------------------------------------------------------------
        | DATABASE INSERT
        |--------------------------------------------------------------------------
        |
        | Connect this section to your existing help-desk/support table.
        |
        | Example if your existing connection is $conn:
        |
        | $stmt = $conn->prepare("
        |     INSERT INTO help_requests
        |     (name, email, order_number, category, subject, message, status, created_at)
        |     VALUES (?, ?, ?, ?, ?, ?, 'Open', NOW())
        | ");
        |
        | $stmt->bind_param(
        |     "ssssss",
        |     $form_name,
        |     $form_email,
        |     $form_order,
        |     $form_category,
        |     $form_subject,
        |     $form_message
        | );
        |
        | $stmt->execute();
        |
        |--------------------------------------------------------------------------
        */

        /*
         * For now, show a successful submission message.
         *
         * Once your database connection is supplied, this section
         * should be replaced with the actual INSERT.
         */

        $success_message = 'Your request has been received. We will get back to you soon.';

        // Clear form after successful submission
        $form_name = '';
        $form_email = '';
        $form_order = '';
        $form_subject = '';
        $form_category = '';
        $form_message = '';
    }
}


/*
|--------------------------------------------------------------------------
| ESCAPE HELPER
|--------------------------------------------------------------------------
*/

function e($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Help Desk | कला'ctive</title>

    <meta name="description"
          content="कला'ctive Help Desk, FAQs and Terms & Conditions.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@400;500;600&display=swap"
          rel="stylesheet">


    <style>

        /* =========================================================
           RESET
        ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #eee4d1;
            color: #2e2924;
            font-family: "DM Sans", sans-serif;
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }


        /* =========================================================
           PAGE TEXTURE
        ========================================================= */

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.12;

            background-image:
                radial-gradient(
                    rgba(72, 55, 38, 0.22) 0.6px,
                    transparent 0.7px
                );

            background-size: 7px 7px;
            z-index: -1;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .site-header {
            height: 88px;
            padding: 0 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom: 1px solid rgba(67, 54, 42, 0.22);

            background: rgba(238, 228, 209, 0.96);

            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left,
        .nav-right {
            display: flex;
            align-items: center;
        }

        .nav-left {
            gap: 36px;
        }

        .nav-right {
            gap: 22px;
        }

        .nav-link {
            font-size: 12px;
            letter-spacing: 0.16em;
            text-transform: uppercase;

            color: #3f3831;

            position: relative;

            transition: opacity 0.25s ease;
        }

        .nav-link:hover {
            opacity: 0.62;
        }

        .nav-link.active {
            color: #9b4e2e;
        }

        .nav-link.active::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -7px;

            height: 1px;

            background: #9b4e2e;
        }

        .brand {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);

            font-family: "Cormorant Garamond", serif;

            font-size: 36px;
            font-weight: 600;

            color: #403a34;

            letter-spacing: -0.04em;
        }

        .brand-subtitle {
            position: absolute;

            top: 66px;
            left: 50%;
            transform: translateX(-50%);

            font-size: 7px;
            letter-spacing: 0.28em;
            white-space: nowrap;

            color: #76685b;
        }

        .nav-icon {
            font-size: 20px;
            line-height: 1;
        }


        /* =========================================================
           HERO
        ========================================================= */

        .help-hero {
            max-width: 1200px;
            margin: auto;

            padding: 105px 6% 90px;

            text-align: center;
        }

        .eyebrow {
            font-size: 10px;
            letter-spacing: 0.28em;
            text-transform: uppercase;

            color: #9b4e2e;

            margin-bottom: 18px;
        }

        .hero-title {
            font-family: "Cormorant Garamond", serif;

            font-size: clamp(58px, 8vw, 105px);

            font-weight: 500;
            line-height: 0.9;

            color: #342d27;

            margin-bottom: 26px;
        }

        .hero-description {
            max-width: 550px;

            margin: auto;

            font-family: "Cormorant Garamond", serif;

            font-size: 22px;
            line-height: 1.4;

            color: #675a4d;
        }


        /* =========================================================
           SECTION
        ========================================================= */

        .section {
            max-width: 1180px;
            margin: auto;

            padding: 85px 6%;

            border-top: 1px solid rgba(67, 54, 42, 0.2);
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;

            gap: 40px;

            margin-bottom: 45px;
        }

        .section-number {
            font-size: 10px;
            letter-spacing: 0.22em;
            color: #9b4e2e;

            margin-bottom: 8px;
        }

        .section-title {
            font-family: "Cormorant Garamond", serif;

            font-size: clamp(42px, 5vw, 68px);

            font-weight: 500;
            line-height: 0.95;

            color: #352e28;
        }

        .section-intro {
            max-width: 420px;

            color: #74685d;

            font-size: 14px;
        }


        /* =========================================================
           HELP CATEGORIES
        ========================================================= */

        .help-categories {
            display: grid;

            grid-template-columns: repeat(3, 1fr);

            border-top: 1px solid rgba(67, 54, 42, 0.25);
            border-left: 1px solid rgba(67, 54, 42, 0.25);
        }

        .help-category {
            padding: 30px;

            min-height: 160px;

            border-right: 1px solid rgba(67, 54, 42, 0.25);
            border-bottom: 1px solid rgba(67, 54, 42, 0.25);

            transition:
                background 0.25s ease,
                transform 0.25s ease;
        }

        .help-category:hover {
            background: rgba(255,255,255,0.16);
        }

        .category-number {
            font-size: 10px;
            letter-spacing: 0.2em;

            color: #9b4e2e;

            margin-bottom: 22px;
        }

        .category-title {
            font-family: "Cormorant Garamond", serif;

            font-size: 30px;

            margin-bottom: 8px;
        }

        .category-description {
            font-size: 12px;
            color: #776b60;
        }


        /* =========================================================
           FAQ
        ========================================================= */

        .faq-list {
            border-top: 1px solid rgba(67, 54, 42, 0.3);
        }

        .faq-item {
            border-bottom: 1px solid rgba(67, 54, 42, 0.3);
        }

        .faq-question {
            width: 100%;

            border: none;
            background: none;

            padding: 24px 0;

            display: flex;
            justify-content: space-between;
            align-items: center;

            text-align: left;

            cursor: pointer;

            color: #332c26;
        }

        .faq-question span:first-child {
            font-family: "Cormorant Garamond", serif;

            font-size: 24px;
        }

        .faq-plus {
            font-size: 23px;
            font-weight: 300;

            transition: transform 0.25s ease;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;

            transition:
                max-height 0.35s ease,
                padding 0.35s ease;
        }

        .faq-answer-inner {
            max-width: 750px;

            padding-bottom: 0;

            font-size: 14px;
            color: #70645a;
        }

        .faq-item.open .faq-answer {
            max-height: 300px;
        }

        .faq-item.open .faq-answer-inner {
            padding-bottom: 24px;
        }

        .faq-item.open .faq-plus {
            transform: rotate(45deg);
        }


        /* =========================================================
           CONTACT / FORM
        ========================================================= */

        .contact-layout {
            display: grid;

            grid-template-columns: 0.8fr 1.2fr;

            gap: 80px;

            align-items: start;
        }

        .contact-copy h3 {
            font-family: "Cormorant Garamond", serif;

            font-size: 42px;
            font-weight: 500;

            margin-bottom: 15px;
        }

        .contact-copy p {
            font-size: 14px;

            color: #70645a;

            max-width: 350px;
        }

        .contact-note {
            margin-top: 30px;

            padding-top: 20px;

            border-top: 1px solid rgba(67,54,42,0.25);

            font-size: 11px;

            color: #8a7b6d;
        }

        .form-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 24px;
        }

        .form-group {
            display: flex;
            flex-direction: column;

            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 10px;

            letter-spacing: 0.17em;

            text-transform: uppercase;

            color: #675a4d;
        }

        .form-control {
            width: 100%;

            border: none;
            border-bottom: 1px solid rgba(67,54,42,0.35);

            background: transparent;

            padding: 12px 2px;

            outline: none;

            color: #342d27;

            border-radius: 0;

            transition: border-color 0.2s ease;
        }

        .form-control:focus {
            border-color: #9b4e2e;
        }

        textarea.form-control {
            min-height: 130px;

            resize: vertical;
        }

        select.form-control {
            cursor: pointer;
        }

        .submit-button {
            margin-top: 15px;

            padding: 15px 30px;

            border: 1px solid #43382f;

            background: #43382f;

            color: #eee4d1;

            cursor: pointer;

            font-size: 10px;

            letter-spacing: 0.2em;

            text-transform: uppercase;

            transition:
                background 0.25s ease,
                color 0.25s ease;
        }

        .submit-button:hover {
            background: transparent;

            color: #43382f;
        }


        /* =========================================================
           MESSAGES
        ========================================================= */

        .message {
            padding: 14px 18px;

            margin-bottom: 30px;

            font-size: 13px;

            border: 1px solid;
        }

        .message.success {
            border-color: rgba(63, 93, 59, 0.35);

            color: #3f5d3b;

            background: rgba(63,93,59,0.05);
        }

        .message.error {
            border-color: rgba(155,78,46,0.4);

            color: #8b4228;

            background: rgba(155,78,46,0.05);
        }


        /* =========================================================
           TERMS
        ========================================================= */

        .terms {
            max-width: 850px;
        }

        .terms-intro {
            font-family: "Cormorant Garamond", serif;

            font-size: 24px;

            line-height: 1.45;

            margin-bottom: 50px;

            color: #51473f;
        }

        .terms-block {
            padding: 28px 0;

            border-top: 1px solid rgba(67,54,42,0.25);
        }

        .terms-block:last-child {
            border-bottom: 1px solid rgba(67,54,42,0.25);
        }

        .terms-block h3 {
            font-family: "Cormorant Garamond", serif;

            font-size: 28px;

            font-weight: 600;

            margin-bottom: 12px;
        }

        .terms-block p {
            font-size: 13px;

            line-height: 1.8;

            color: #70645a;
        }

        .last-updated {
            margin-top: 25px;

            font-size: 10px;

            letter-spacing: 0.15em;

            text-transform: uppercase;

            color: #88796b;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        footer {
            margin-top: 40px;

            padding: 65px 6% 35px;

            background: #332d27;

            color: #eee4d1;
        }

        .footer-inner {
            max-width: 1180px;

            margin: auto;

            display: flex;

            justify-content: space-between;

            gap: 40px;
        }

        .footer-brand {
            font-family: "Cormorant Garamond", serif;

            font-size: 38px;
        }

        .footer-subtitle {
            font-size: 8px;

            letter-spacing: 0.25em;

            margin-top: 4px;

            opacity: 0.65;
        }

        .footer-links {
            display: flex;

            gap: 28px;

            align-items: center;
        }

        .footer-links a {
            font-size: 10px;

            letter-spacing: 0.14em;

            text-transform: uppercase;

            opacity: 0.8;
        }

        .footer-links a:hover {
            opacity: 1;
        }

        .copyright {
            max-width: 1180px;

            margin: 45px auto 0;

            padding-top: 20px;

            border-top: 1px solid rgba(238,228,209,0.18);

            font-size: 10px;

            opacity: 0.5;
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 800px) {

            .site-header {
                height: 72px;

                padding: 0 20px;
            }

            .nav-left {
                gap: 15px;
            }

            .nav-link {
                font-size: 9px;
                letter-spacing: 0.1em;
            }

            .brand {
                font-size: 27px;
            }

            .brand-subtitle {
                display: none;
            }

            .nav-right {
                gap: 10px;
            }

            .nav-icon {
                font-size: 17px;
            }

            .help-hero {
                padding: 80px 25px 70px;
            }

            .hero-title {
                font-size: 65px;
            }

            .hero-description {
                font-size: 19px;
            }

            .section {
                padding: 65px 25px;
            }

            .section-heading {
                display: block;
            }

            .section-intro {
                margin-top: 20px;
            }

            .help-categories {
                grid-template-columns: 1fr;
            }

            .contact-layout {
                grid-template-columns: 1fr;

                gap: 45px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .footer-inner {
                flex-direction: column;
            }

            .footer-links {
                flex-wrap: wrap;
            }
        }

    </style>

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header class="site-header">

    <nav class="nav-left">

        <a href="index.php" class="nav-link">
            Shop
        </a>

        <a href="collection.php" class="nav-link">
            Collections
        </a>

        <a href="rooms.php" class="nav-link">
            Rooms
        </a>

        <a href="our-story.php" class="nav-link">
            Our Story
        </a>

    </nav>


    <a href="index.php" class="brand">
        कला'ctive
    </a>

    <div class="brand-subtitle">
        A CURATION BY RANGREZ
    </div>


    <div class="nav-right">

        <a href="wishlist.php"
           class="nav-icon"
           aria-label="Wishlist">
            ♡
        </a>

        <a href="cart.php"
           class="nav-icon"
           aria-label="Cart">
            ♧
        </a>

        <a href="login.php"
           class="nav-icon"
           aria-label="Account">
            ♙
        </a>

    </div>

</header>



<!-- =========================================================
     HERO
========================================================= -->

<section class="help-hero">

    <div class="eyebrow">
        कला'ctive / Assistance
    </div>

    <h1 class="hero-title">
        Help Desk
    </h1>

    <p class="hero-description">
        Questions about an order, a product, or something else?
        Find an answer below or send us a message.
    </p>

</section>



<!-- =========================================================
     HELP CATEGORIES
========================================================= -->

<section class="section" id="help">

    <div class="section-heading">

        <div>

            <div class="section-number">
                01 — HELP
            </div>

            <h2 class="section-title">
                How can we help?
            </h2>

        </div>

        <p class="section-intro">
            A few useful places to start. If you cannot find what
            you need, send us a request below.
        </p>

    </div>


    <div class="help-categories">

        <a href="#faq" class="help-category">

            <div class="category-number">
                01
            </div>

            <h3 class="category-title">
                Orders
            </h3>

            <p class="category-description">
                Questions about placing or managing an order.
            </p>

        </a>


        <a href="#faq" class="help-category">

            <div class="category-number">
                02
            </div>

            <h3 class="category-title">
                Shipping
            </h3>

            <p class="category-description">
                Delivery and order-status information.
            </p>

        </a>


        <a href="#faq" class="help-category">

            <div class="category-number">
                03
            </div>

            <h3 class="category-title">
                Returns
            </h3>

            <p class="category-description">
                Questions about returns or damaged products.
            </p>

        </a>


        <a href="#faq" class="help-category">

            <div class="category-number">
                04
            </div>

            <h3 class="category-title">
                Products
            </h3>

            <p class="category-description">
                Product information and availability.
            </p>

        </a>


        <a href="#faq" class="help-category">

            <div class="category-number">
                05
            </div>

            <h3 class="category-title">
                Payments
            </h3>

            <p class="category-description">
                Payment and billing questions.
            </p>

        </a>


        <a href="#contact" class="help-category">

            <div class="category-number">
                06
            </div>

            <h3 class="category-title">
                Contact
            </h3>

            <p class="category-description">
                Send a message directly to our Help Desk.
            </p>

        </a>

    </div>

</section>



<!-- =========================================================
     FAQ
========================================================= -->

<section class="section" id="faq">

    <div class="section-heading">

        <div>

            <div class="section-number">
                02 — QUESTIONS
            </div>

            <h2 class="section-title">
                Frequently asked
            </h2>

        </div>

        <p class="section-intro">
            Some common questions from customers.
        </p>

    </div>


    <div class="faq-list">


        <div class="faq-item">

            <button class="faq-question">

                <span>
                    How can I place an order?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-inner">
                    Browse the Collection, open a product to view
                    its details, and use the available purchase or
                    cart option to continue with your order.
                </div>

            </div>

        </div>



        <div class="faq-item">

            <button class="faq-question">

                <span>
                    How can I check my order?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-inner">
                    If your account and order system provides order
                    tracking, sign in to your account and open your
                    orders section.
                </div>

            </div>

        </div>



        <div class="faq-item">

            <button class="faq-question">

                <span>
                    Can I cancel an order?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-inner">
                    Cancellation depends on the status of the order.
                    Please contact the Help Desk with your order
                    number as soon as possible.
                </div>

            </div>

        </div>



        <div class="faq-item">

            <button class="faq-question">

                <span>
                    What if my product arrives damaged?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-inner">
                    Contact the Help Desk with your order number
                    and details of the issue. If appropriate, include
                    photographs of the product and packaging.
                </div>

            </div>

        </div>



        <div class="faq-item">

            <button class="faq-question">

                <span>
                    How can I contact कला'ctive?
                </span>

                <span class="faq-plus">
                    +
                </span>

            </button>

            <div class="faq-answer">

                <div class="faq-answer-inner">
                    Use the Help Desk form on this page and provide
                    your order number when your request relates to
                    an existing order.
                </div>

            </div>

        </div>


    </div>

</section>



<!-- =========================================================
     CONTACT FORM
========================================================= -->

<section class="section" id="contact">

    <div class="section-heading">

        <div>

            <div class="section-number">
                03 — CONTACT
            </div>

            <h2 class="section-title">
                Send a request
            </h2>

        </div>

        <p class="section-intro">
            Tell us what you need help with and provide your order
            number if your question concerns an existing purchase.
        </p>

    </div>


    <?php if ($success_message): ?>

        <div class="message success">
            <?php echo e($success_message); ?>
        </div>

    <?php endif; ?>


    <?php if ($error_message): ?>

        <div class="message error">
            <?php echo e($error_message); ?>
        </div>

    <?php endif; ?>


    <div class="contact-layout">


        <div class="contact-copy">

            <h3>
                We are listening.
            </h3>

            <p>
                Whether you have a question about a piece,
                an order, or something you could not find,
                leave us a note.
            </p>

            <div class="contact-note">
                Please avoid sharing passwords or other
                sensitive account information.
            </div>

        </div>



        <form method="POST"
              action="help.php#contact"
              novalidate>

            <div class="form-grid">


                <div class="form-group">

                    <label class="form-label">
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo e($form_name); ?>"
                        maxlength="100"
                        required
                    >

                </div>



                <div class="form-group">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?php echo e($form_email); ?>"
                        maxlength="150"
                        required
                    >

                </div>



                <div class="form-group">

                    <label class="form-label">
                        Order Number
                    </label>

                    <input
                        type="text"
                        name="order_number"
                        class="form-control"
                        value="<?php echo e($form_order); ?>"
                        maxlength="100"
                    >

                </div>



                <div class="form-group">

                    <label class="form-label">
                        Category
                    </label>

                    <select
                        name="category"
                        class="form-control"
                        required
                    >

                        <option value="">
                            Select
                        </option>

                        <option value="Order"
                            <?php echo $form_category === 'Order' ? 'selected' : ''; ?>>
                            Order
                        </option>

                        <option value="Shipping"
                            <?php echo $form_category === 'Shipping' ? 'selected' : ''; ?>>
                            Shipping
                        </option>

                        <option value="Return"
                            <?php echo $form_category === 'Return' ? 'selected' : ''; ?>>
                            Return
                        </option>

                        <option value="Product"
                            <?php echo $form_category === 'Product' ? 'selected' : ''; ?>>
                            Product
                        </option>

                        <option value="Payment"
                            <?php echo $form_category === 'Payment' ? 'selected' : ''; ?>>
                            Payment
                        </option>

                        <option value="Account"
                            <?php echo $form_category === 'Account' ? 'selected' : ''; ?>>
                            Account
                        </option>

                        <option value="Other"
                            <?php echo $form_category === 'Other' ? 'selected' : ''; ?>>
                            Other
                        </option>

                    </select>

                </div>



                <div class="form-group full">

                    <label class="form-label">
                        Subject
                    </label>

                    <input
                        type="text"
                        name="subject"
                        class="form-control"
                        value="<?php echo e($form_subject); ?>"
                        maxlength="200"
                        required
                    >

                </div>



                <div class="form-group full">

                    <label class="form-label">
                        Message
                    </label>

                    <textarea
                        name="message"
                        class="form-control"
                        maxlength="5000"
                        required
                    ><?php echo e($form_message); ?></textarea>

                </div>


            </div>


            <button
                type="submit"
                class="submit-button"
            >
                Send Request
            </button>

        </form>

    </div>

</section>



<!-- =========================================================
     TERMS & CONDITIONS
========================================================= -->

<section class="section" id="terms">

    <div class="section-heading">

        <div>

            <div class="section-number">
                04 — TERMS
            </div>

            <h2 class="section-title">
                Terms & Conditions
            </h2>

        </div>

        <p class="section-intro">
            Please read these terms before using the कला'ctive
            website or placing an order.
        </p>

    </div>


    <div class="terms">

        <p class="terms-intro">
            These terms describe the general conditions for using
            the कला'ctive website and purchasing products through it.
        </p>



        <div class="terms-block">

            <h3>
                1. General
            </h3>

            <p>
                By accessing and using the कला'ctive website, you
                agree to use the website lawfully and responsibly.
                The website and its content are intended to provide
                information about कला'ctive products and services.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                2. Orders
            </h3>

            <p>
                Orders are subject to product availability and
                successful payment where applicable. कला'ctive
                reserves the right to contact a customer if there
                is an issue with an order or the information supplied.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                3. Pricing & Payments
            </h3>

            <p>
                Product prices shown on the website are displayed
                for the applicable products at the time of purchase.
                Available payment methods are presented during the
                checkout process.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                4. Product Information
            </h3>

            <p>
                We make reasonable efforts to display product
                descriptions, photographs and other information
                accurately. Colours and appearance may vary
                depending on display settings and photography.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                5. Shipping & Delivery
            </h3>

            <p>
                Delivery arrangements depend on the order,
                destination and shipping options available at
                checkout. Where applicable, customers should
                provide accurate delivery information when placing
                an order.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                6. Returns & Exchanges
            </h3>

            <p>
                Returns or exchanges are subject to the return
                policy applicable to the purchased product.
                Customers should contact the Help Desk if they
                need assistance with a return request.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                7. Damaged Products
            </h3>

            <p>
                If an order arrives damaged, contact the Help Desk
                promptly with the relevant order information and
                details of the damage so that the matter can be
                reviewed.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                8. Intellectual Property
            </h3>

            <p>
                Website content including brand elements,
                photography, graphics, text and other original
                material belongs to कला'ctive or its respective
                rights holders and should not be reproduced or
                used without appropriate permission.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                9. Website Use
            </h3>

            <p>
                Users must not attempt to interfere with the
                operation or security of the website, gain
                unauthorized access to restricted areas, or use
                the website for unlawful purposes.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                10. Changes to These Terms
            </h3>

            <p>
                These Terms & Conditions may be updated from time
                to time. The latest version published on this page
                will apply to future use of the website, subject
                to applicable law.
            </p>

        </div>



        <div class="terms-block">

            <h3>
                11. Contact
            </h3>

            <p>
                If you have a question about these terms or an
                order, please use the Help Desk above and include
                relevant information where appropriate.
            </p>

        </div>


        <div class="last-updated">
            Last Updated: <?php echo date('d F Y'); ?>
        </div>

    </div>

</section>



<!-- =========================================================
     FOOTER
========================================================= -->

<footer>

    <div class="footer-inner">

        <div>

            <div class="footer-brand">
                कला'ctive
            </div>

            <div class="footer-subtitle">
                A CURATION BY RANGREZ
            </div>

        </div>


        <div class="footer-links">

            <a href="collection.php">
                Collections
            </a>

            <a href="help.php#help">
                Help
            </a>

            <a href="help.php#terms">
                Terms
            </a>

            <a href="login.php">
                Account
            </a>

        </div>

    </div>


    <div class="copyright">
        © <?php echo date('Y'); ?> कला'ctive. All rights reserved.
    </div>

</footer>



<!-- =========================================================
     FAQ JAVASCRIPT
========================================================= -->

<script>

    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach(item => {

        const button = item.querySelector(".faq-question");

        button.addEventListener("click", () => {

            const currentlyOpen =
                document.querySelector(".faq-item.open");

            if (currentlyOpen && currentlyOpen !== item) {
                currentlyOpen.classList.remove("open");
            }

            item.classList.toggle("open");

        });

    });

</script>


</body>
</html>