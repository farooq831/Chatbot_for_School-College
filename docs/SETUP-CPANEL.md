# Setup guide for office and admin staff (cPanel)

No programming needed. You only use **cPanel → File Manager**.

## 1. Put the chatbot on the main website
1. File Manager → `public_html` → **+ Folder** → name it `chatbot`.
2. Upload these files into it: `chatbot.js`, `chatbot.css`, `campuses.js`, `faq.js`, `demo.html`, `.htaccess`.
   (`.htaccess` is a hidden file: **Settings → Show Hidden Files**.)
3. Test: open `https://your-school.edu/chatbot/demo.html`. A round button appears bottom-left, and a greeting shows after 2–3 seconds.
4. Back up `public_html/index.html` (Copy → `index.html.bak`), then **Edit** it and paste this just **before** `</body>`:
   ```html
   <script src="/chatbot/chatbot.js?v=3" defer></script>
   ```
5. Open the website, press **Ctrl + F5**, and check the button is there.

## 2. Add it to a campus website
Edit the shared footer file (for example `includes/footer.php`), back it up first, and paste just **before** `</body>`:
```html
<script src="https://your-school.edu/chatbot/chatbot.js?v=3" defer></script>
```
The campus is recognised from its web address (the `url` in `campuses.js`).

## 3. Change a question, answer or phone number
1. Open `faq.js` (questions) or `campuses.js` (campuses, phones, WhatsApp) in File Manager → **Edit**.
2. Change the text inside the `"double quotes"`. Keep the commas between blocks.
3. **Save.** Every website shows the change within an hour.

> If you make a mistake, the chat button simply disappears. The website keeps working. Undo your last edit and the button comes back.

## 4. Real fees in the chat (optional)
Upload `chat-fees.php` into each campus website folder (next to `index.php`).
Test it at `https://<campus address>/chat-fees.php`. It must show text starting with `{"campus":`.
Then type **class 5 fee** in that campus chat, and the amounts appear.
If the page shows an error, delete the file again. The chat keeps working with the Fee Structure link.

## 5. Button position
The button sits **bottom-left** so it never covers the WhatsApp button. For bottom-right, add `data-position="right"` to the script line.
