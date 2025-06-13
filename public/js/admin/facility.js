let facilityId = 0;

const addFacility = () => {
    facilityId++;
    const html = `
        <div class="flex justify-between items-start gap-4 mb-4" id="facility-${facilityId}">
            <div class="grid grid-cols-4 gap-3 w-full">
                <div class="col-span-4">
                    <label for="facility_name_${facilityId}" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Name</label>
                    <input 
                        type="text" 
                        id="facility_name_${facilityId}" 
                        name="facility_name[]" 
                        class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Input facility name here" 
                        required 
                    />
                </div>
                <div class="col-span-2">
                    <label for="facility_condition_${facilityId}" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Condition</label>
                    <select 
                        id="facility_condition_${facilityId}" 
                        name="facility_condition[]" 
                        class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        required>
                        <option selected disabled>Choose condition</option>
                        <option value="good">Good</option>
                        <option value="fair">Fair</option>
                        <option value="broken">Broken</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="facility_total_${facilityId}" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Facility</label>
                    <input 
                        type="number" 
                        id="facility_total_${facilityId}" 
                        name="facility_total[]" 
                        class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Total" 
                        required 
                    />
                </div>
            </div>
            <div class="flex flex-col gap-2 mt-6">
                <button type="button" onclick="deleteFacility(${facilityId})" class="py-1 px-3 text-xs rounded-full bg-red-400 text-white">Delete</button>
                <button type="button" onclick="addFacility()" class="py-1 px-3 text-xs rounded-full bg-yellow-300 text-gray-900">Add</button>
            </div>
        </div>
    `;
    $('#facility-container').append(html);
};

const deleteFacility = (id) => {
    if (id > 0) {
        $(`#facility-${id}`).remove();
    }
}

const deleteFacilityFromDatabase = (id) => {
    $.ajax({
        url: "/admin/delete-class-facility",
        type: "DELETE",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        data: {id},
        success: function(response) {
            getNotification(response.message, response.status);

            if(response.status) {
                window.location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            notyf.error("An error occurred. Please try again.");
            $btn.prop("disabled", false);
            $btn.html(`<div class="mt-5 cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Resend OTP</div>`);
        }
    })
}