// Firebase Realtime Database URL
const firebaseUrl = "https://project-2e353-default-rtdb.firebaseio.com/messages.json";

// Get the form element
const form = document.getElementById("contactForm");

// Handle form submission
form.addEventListener("submit", async (event) => {
  event.preventDefault(); // Prevent page reload

  // Get form data
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const message = document.getElementById("message").value;

  // Prepare data for Firebase
  const data = {
    name: name,
    email: email,
    message: message,
    timestamp: new Date().toISOString(),
  };

  try {
    // Send data to Firebase using POST
    const response = await fetch(firebaseUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    if (response.ok) {
      alert("Message sent successfully!");
      form.reset(); // Clear the form
    } else {
      const errorData = await response.json();
      console.error("Error response:", errorData);
      alert("Failed to send message. Try again later.");
    }
  } catch (error) {
    console.error("Error occurred:", error);
    alert("An error occurred. Please try again.");
  }
});
