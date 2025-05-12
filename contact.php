<!-- contact.php -->
<?php include 'includes/header.php'; ?>
<main>
    <head><link rel="stylesheet" href="styles/styles.css"></head>
    <div class="contact">
    <h2>Contact Us</h2>
    <p>If you have any questions or would like to get in touch with us, please fill out the form below or use the contact information provided. We will get back to you as soon as possible.</p>
    
    <form action="contact_process.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br>

        <input type="submit" value="Submit">
    </form>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
