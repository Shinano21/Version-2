function previewImage(event) {
  const input = event.target;
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const previewImage = document.getElementById("preview");
      previewImage.src = e.target.result;
      previewImage.style.display = "block";
    };
    reader.readAsDataURL(input.files[0]);
  }
}

const imageInput = document.getElementById("imageInput");
imageInput.addEventListener("change", previewImage);
