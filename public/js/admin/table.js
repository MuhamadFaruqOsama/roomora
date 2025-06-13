$(document).ready(function () {
    if ($("#table-admin-grid").length) {

        const headTable = $("#table-admin-grid").data('tableHeader').split(',')
        const dataTable = $("#table-admin-grid").data('tableData')
        const dataTitle = $("#table-admin-grid").data('title')
        
        let arrayFormatDataTable
        if(dataTitle == "complaint") {
            arrayFormatDataTable = complaintTable(dataTable);
        } else if(dataTitle == "class-management") {
            arrayFormatDataTable = classManagementTable(dataTable);
        } else if(dataTitle == "class-facility") {
            arrayFormatDataTable = classFacilityTable(dataTable);
        } else if(dataTitle == "booking-class") {
            arrayFormatDataTable = classBookingTable(dataTable);
        } else if(dataTitle == "schedule") {
            arrayFormatDataTable = scheduleTable(dataTable);
        } else {
            arrayFormatDataTable = []
        }

        let dataGeneralTable = [...arrayFormatDataTable]
        
        const gridTable = new gridjs.Grid({
            columns: headTable,
            search: true,
            sort: true,
            fixedHeader: true,
            pagination: true,
            resizable: true,
            fixedHeader: true,
            data: arrayFormatDataTable
        }).render(document.getElementById("table-admin-grid"));

        // REALTIME TABLE =======================================================================================
        
        if(dataTitle == "complaint") {

            // TABLE COMPLAINT REALTIME 
            window.Echo.channel('complaint-to-admin')
                .listen('ComplaintSent', (e) => {
                    const newRow = complaintTableSingle(e.message)
                    dataGeneralTable.unshift(newRow)
                    
                    // add to table
                    gridTable.updateConfig({
                        data: dataGeneralTable
                    }).forceRender();
                });

            // CONFIRM COMPLAINT REALTIME 
            window.Echo.channel('confirm-complaint-to-admin')
                .listen('ConfirmComplaintSent', (e) => {
                    $(`#complaint-badge-${e.data.id}`).html(`<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-blue-100 text-blue-500">confirmed</span>`)
                });
            
        } else if(dataTitle == "booking-class") {
            
            // TABLE BOOKING CLASS REALTIME 
            window.Echo.channel('booking-class-to-admin')
                .listen('BookingClassSent', (e) => {
                    const newRow = classBookingTableSingle(e.message)
                    dataGeneralTable.unshift(newRow)
                    
                    // add to table
                    gridTable.updateConfig({
                        data: dataGeneralTable
                    }).forceRender();
                });
            
        } else {
            console.log('not found event');
        }
    }
});

const complaintTable = (dataTable) => {
    return dataTable.map(item => {
        let statusBadge;

        if (item.status === "pending") {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-yellow-100 text-yellow-500">${item.status}</span>`;
        } else if (item.status === "rejected") {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-red-100 text-red-500">${item.status}</span>`;
        } else if (item.status === "finished") {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-green-100 text-green-500">${item.status}</span>`;
        } else {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-blue-100 text-blue-500">${item.status}</span>`;
        }

        return [
            gridjs.html(`
                <div class="flex items-center justify-center">
                    <img src="../storage/${item.photo}" alt="${item.class}" class="w-36" loading="lazy"/>
                </div>
            `),
            gridjs.html(`
                <div class="font-semibold text-gray-600">${item.class}</div>    
                <div class="text-sm text-gray-400">${item.title}</div>    
            `),
            gridjs.html(`
                <div id="complaint-badge-${item.id}">
                    ${statusBadge}
                </div>
                <div class="text-sm text-gray-400">${item.created_at}</div>    
            `),
            gridjs.html(`
                <a href="/admin/facility-complaint/${item.id}" class="bg-green-500 mx-auto text-white py-1 px-4 rounded-full hover:bg-green-600 text-xs font-semibold">
                View
                </a>    
            `)
        ];
    });
};

const complaintTableSingle = (dataTable) => {
    let statusBadge;

    if (dataTable.status === "pending") {
        statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-yellow-100 text-yellow-500">${dataTable.status}</span>`;
    } else if (dataTable.status === "rejected") {
        statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-red-100 text-red-500">${dataTable.status}</span>`;
    } else if (dataTable.status === "finished") {
        statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-green-100 text-green-500">${dataTable.status}</span>`;
    } else {
        statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-blue-100 text-blue-500">${dataTable.status}</span>`;
    }

    return [
        gridjs.html(`
            <div class="flex items-center justify-center">
                <img src="../storage/${dataTable.photo}" alt="${dataTable.class}" class="w-36" loading="lazy"/>
            </div>
        `),
        gridjs.html(`
            <div class="font-semibold text-gray-600">${dataTable.class}</div>    
            <div class="text-sm text-gray-400">${dataTable.title}</div>    
        `),
        gridjs.html(`
            <div id="complaint-badge-${dataTable.id}">
                ${statusBadge}
            </div>
            <div class="text-sm text-gray-400">${dataTable.created_at}</div>    
        `),
        gridjs.html(`
            <a href="/admin/facility-complaint/${dataTable.id}" class="bg-green-500 mx-auto text-white py-1 px-4 rounded-full hover:bg-green-600 text-xs font-semibold">
            View
            </a>    
        `)
    ];
}

const classManagementTable = (dataTable) => {
  return dataTable.map(item => {

    return [
        item.code,
        item.name,
        gridjs.html(`
            <div class="flex items-center justify-center">
                <img src="../storage/${item.photo}" alt="${item.class}" class="w-36" loading="lazy"/>
            </div>    
        `),
        item.desc,
        item.created_at,
        gridjs.html(`
            <div class="flex flex-col items-center justify-center gap-1">
                <a href="/admin/class-management/${item.id}" class="bg-green-500 text-white py-1 px-4 rounded-full hover:bg-green-600 text-xs font-semibold">
                    View
                </a>
                <a href="/admin/edit-class/${item.id}" class="bg-yellow-500 text-white py-1 px-4 rounded-full hover:bg-yellow-600 text-xs font-semibold">
                    Edit
                </a>
                <button type="button" onclick="confirmModal('Do you really want to delete this class?', ${item.id})" class="bg-red-500 text-white py-1 px-4 rounded-full hover:bg-red-600 text-xs font-semibold">
                    Delete
                </button>
            </div> 
        `)
    ];
  });
};

const classFacilityTable = (dataTable) => {
    return dataTable.map(item => {
        let conditionBadge;

        if (item.condition === "good") {
            conditionBadge = `<span class="text-green-500 px-2 py-1 rounded-full text-xs bg-green-100">${item.condition}</span>`;
        } else if (item.condition === "fair") {
            conditionBadge = `<span class="text-yellow-500 px-2 py-1 rounded-full text-xs bg-yellow-100">${item.condition}</span>`;
        } else if (item.condition === "broken") {
            conditionBadge = `<span class="text-red-500 px-2 py-1 rounded-full text-xs bg-red-100">${item.condition}</span>`;
        } else {
            conditionBadge = `<span class="text-blue-500 px-2 py-1 rounded-full text-xs bg-blue-100">${item.condition}</span>`;
        }

        return [
            gridjs.html(`<div class="text-sm text-gray-700 font-medium">${item.name}</div>`),
            gridjs.html(`${conditionBadge}`),
            gridjs.html(`<div class="text-sm text-gray-700">${item.total}</div>`),
            gridjs.html(`
                <button type="button" onclick="deleteFacilityFromDatabase(${item.id})" class="bg-red-500 mx-auto text-white cursor-pointer py-1 px-4 rounded-full hover:bg-red-600 text-xs font-semibold">
                    Delete
                </button>    
            `)
        ];
    });
};

const classBookingTable = (dataTable) => {
    return dataTable.map(item => {
        let statusBadge;

        if (item.status === "pending") {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-yellow-100 text-yellow-500">${item.status}</span>`;
        } else if (item.status === "rejected") {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-red-100 text-red-500">${item.status}</span>`;
        } else {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-green-100 text-green-500">${item.status}</span>`;
        } 

        return [
            gridjs.html(`
                <div class="text-gray-700 font-semibold">${item.class}</div>
                <div class="text-gray-500 text-xs line-clamp-2">${item.desc_class}</div>
            `),
            gridjs.html(`
                <div class="text-gray-700 font-semibold">${item.day}</div>
                <div class="text-gray-500 text-xs line-clamp-2">${item.date}</div>
            `),
            gridjs.html(`
                <div class="text-gray-700 font-semibold">${item.title}</div>
                <div class="text-gray-500 text-xs line-clamp-2">${item.start} - ${item.end}</div>    
            `),
            gridjs.html(`
                ${statusBadge}
                <div class="text-xs text-gray-700">${item.updated_at}</div>    
            `),
            gridjs.html(`
                <a href="/admin/class-booking/${item.id}" class="bg-green-500 mx-auto text-white py-1 px-4 rounded-full hover:bg-green-600 text-xs font-semibold">
                    View
                </a>
            `)
        ];
    });
}

const classBookingTableSingle = (dataTable) => {
    let statusBadge;

    if (dataTable.status === "pending") {
        statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-yellow-100 text-yellow-500">${dataTable.status}</span>`;
    } else if (dataTable.status === "rejected") {
        statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-red-100 text-red-500">${dataTable.status}</span>`;
    } else {
        statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-green-100 text-green-500">${dataTable.status}</span>`;
    } 

    return [
        gridjs.html(`
            <div class="text-gray-700 font-semibold">${dataTable.class}</div>
            <div class="text-gray-500 text-xs line-clamp-2">${dataTable.desc_class}</div>
        `),
        gridjs.html(`
            <div class="text-gray-700 font-semibold">${dataTable.day}</div>
            <div class="text-gray-500 text-xs line-clamp-2">${dataTable.date}</div>
        `),
        gridjs.html(`
            <div class="text-gray-700 font-semibold">${dataTable.title}</div>
            <div class="text-gray-500 text-xs line-clamp-2">${dataTable.start} - ${dataTable.end}</div>    
        `),
        gridjs.html(`
            ${statusBadge}
            <div class="text-xs text-gray-700">${dataTable.updated_at}</div>    
        `),
        gridjs.html(`
            <a href="/admin/class-booking/${dataTable.id}" class="bg-green-500 mx-auto text-white py-1 px-4 rounded-full hover:bg-green-600 text-xs font-semibold">
                View
            </a>
        `)
    ];
}

const scheduleTable = (dataTable) => {
    return dataTable.map(item => {
        let statusBadge;

        if (item.type === "book") {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-red-100 text-red-500">booking</span>`;
        } else {
            statusBadge = `<span class="py-1 font-semibold px-3 text-xs mb-2 rounded-full bg-green-100 text-green-500">main</span>`;
        } 
        
        return [
            gridjs.html(`
                <div class="text-gray-700 font-semibold">${item.class}</div>
                <div class="text-gray-500 text-xs line-clamp-2">${item.desc_class}</div>
            `),
            gridjs.html(`
                <div class="text-gray-700 font-semibold">${item.day}</div>
                <div class="text-gray-500 text-xs line-clamp-2">${item.start} - ${item.end}</div>
            `),
            gridjs.html(`
                <div class="text-gray-700 font-semibold">${item.subject}</div>
            `),
            gridjs.html(`
                ${statusBadge}
            `),
            gridjs.html(`
                <button onclick="confirmModal('Do you really want to delete this schedule?', ${item.schedule_id})" class="bg-red-500 cursor-pointer mx-auto text-white py-1 px-4 rounded-full hover:bg-red-600 text-xs font-semibold">
                    delete
                </button>
            `)
        ];
    });
}