/* FAQ Section */
const bntsArray = document.querySelectorAll('.accordion');

bntsArray.forEach((btn) => btn.addEventListener('click', toggleBtn))

function toggleBtn() {
    this.classList.toggle('active');

    this.parentElement.classList.toggle('active');

    const panel = this.nextElementSibling;

    if (panel.style.display === 'block') {
        panel.style.display = 'none';
    } else {
        panel.style.display = 'block';
    }
}

/*Back-to-top Button*/
const backBtn = document.getElementById("back-to-top");
backBtn.addEventListener('click', bacToTop);

// When the user scrolls down 50px from the top of the document, the button will appear
window.addEventListener('scroll', scrollFunction);

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        backBtn.style.display = "block";
    } else {
        backBtn.style.display = "none";
    }
}

// When the user clicks on the button, scrolls to the top of the document
function bacToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}