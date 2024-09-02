function updateTime() {
    const now = new Date();

    // date
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June', 'July',
        'August', 'September', 'October', 'November', 'December'
    ];
    const month = months[now.getMonth()];
    const day = now.getDate();
    const year = now.getFullYear();

    // time
    let hours = now.getHours();
    const meridiem = hours >= 12 ? 'PM' : 'AM'; // Determine AM or PM
    hours = hours % 12 || 12; // Convert hours to 12-hour format
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const seconds = now.getSeconds().toString().padStart(2, '0');

    const dateString = `${month} ${day}, ${year}`;
    const timeString = `${hours}:${minutes}:${seconds} ${meridiem}`; // Include AM/PM

    const combinedDateTime = `${dateString} | ${timeString}`;

    document.getElementById('time').innerText = combinedDateTime;
}

function toggleDropdown(event) {
    event.stopPropagation(); // Prevent body click event when button is clicked
    const dropdown = document.getElementById("dropdownContent");

    if (dropdown.style.display === "none" || dropdown.style.display === "") {
        dropdown.style.display = "block";
        // Add event listeners to handle closing dropdown
        document.addEventListener('click', closeDropdownOutside);
        document.addEventListener('scroll', closeDropdownOnScroll);
    } else {
        dropdown.style.display = "none";
        removeEventListeners();
    }
}

function closeDropdownOutside(event) {
    const dropdown = document.getElementById("dropdownContent");

    if (!dropdown.contains(event.target)) {
        dropdown.style.display = "none";
        removeEventListeners();
    }
}

function closeDropdownOnScroll() {
    const dropdown = document.getElementById("dropdownContent");
    dropdown.style.display = "none";
    removeEventListeners();
}

function removeEventListeners() {
    document.removeEventListener('click', closeDropdownOutside);
    document.removeEventListener('scroll', closeDropdownOnScroll);
}

document.addEventListener('DOMContentLoaded', function() {
    updateTime();
    setInterval(updateTime, 1000);

    // Delegate click event for dropdown toggle
    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('dropdown-icon')) {
            toggleDropdown(event);
        }
    });
});

let arrow = document.querySelectorAll(".arrow");
for (var i=0; i<arrow.length; i++){
    arrow[i].addEventListener("click", (e)=>{
        let arrowParent = e.target.parentElement.parentElement;
        console.log(arrowParent)
        arrowParent.classList.toggle("showMenu")
    })
}

let links = document.querySelectorAll(".sidebar .nav-links li a");

for (let i = 0; i < links.length; i++) {
    links[i].addEventListener("click", function(e) {
        let parentLi = e.target.closest("li");
        if (parentLi) {
            // Remove 'active' class from all 'li' elements except the clicked one
            document.querySelectorAll(".sidebar .nav-links li").forEach(li => {
                if (li !== parentLi) {
                    li.classList.remove("active");
                }
            });
            parentLi.classList.toggle("active");
        }
    });
}
document.querySelector(".sidebar .nav-links li:first-child").classList.add("active");





let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
sidebarBtn.addEventListener("click", (e)=>{
    sidebar.classList.toggle("close");
})