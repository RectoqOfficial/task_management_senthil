<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div id="profileContainer" class="max-w-lg w-full p-6"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ route('employee.profile') }}", {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'include'
            })
            .then(response => response.json())
            .then(employee => {
                console.log("Received Employee Data:", employee);

                if (employee.error) {
                    alert("Error: " + employee.error);
                    return;
                }

                if (!employee || !employee.id) {
                    alert("Error: Employee data not found");
                    return;
                }

                // Profile Card
                const cardHTML = `
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-6 text-white text-center">
                            <h2 class="text-2xl font-bold">${employee.name}</h2>
                            <p class="text-sm opacity-90">${employee.role}</p>
                        </div>
                        <div class="p-6 text-gray-700">
                            <p><strong>ID:</strong> ${employee.id}</p>
                            <p><strong>Email:</strong> ${employee.email}</p>
                            <p><strong>Contact:</strong> ${employee.contact}</p>
                            <p><strong>Department:</strong> ${employee.department}</p>
                            <p><strong>Joining Date:</strong> ${employee.joining_date}</p>
                        </div>
                    </div>
                `;

                document.getElementById('profileContainer').innerHTML = cardHTML;
            })
            .catch(error => console.error('Error fetching employee profile:', error));
        });
    </script>

</body>
</html>
