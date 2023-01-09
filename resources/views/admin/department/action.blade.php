<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded"></i>
    </button>
    <div class="dropdown-menu">
        <button class="dropdown-item" onclick="editItem({{ $row }})" data-bs-toggle="modal"
            data-bs-target="#editItem"><i class="bx bx-edit-alt me-1"></i>
            Edit</button>
    </div>
</div>
