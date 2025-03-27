<h1 class="title is-1">Contact Us</h1>


<form action="/contact" method="post">
    <!-- Name Field -->
    <div class="field">
        <label class="label">Name</label>
        <div class="control">
            <input class="input" type="text" name="name" placeholder="Your Name" required>
        </div>
    </div>

    <!-- Email Field -->
    <div class="field">
        <label class="label">Email</label>
        <div class="control">
            <input class="input" type="email" name="email" placeholder="Your Email" required>
        </div>
    </div>

    <!-- Message Field -->
    <div class="field">
        <label class="label">Message</label>
        <div class="control">
            <textarea class="textarea" name="message" placeholder="Your message..." required></textarea>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="field">
        <div class="control">
            <button class="button is-primary is-fullwidth">Send Message</button>
        </div>
    </div>
</form>