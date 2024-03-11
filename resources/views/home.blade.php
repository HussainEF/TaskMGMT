@extends('layouts.main_layout')
    @section('content')
        <!-- Inner content -->
        <div class="content-inner">

            <!-- Page header -->
            <div class="page-header page-header-light page-header-static shadow">
                <div class="page-header-content d-lg-flex">
                    <div class="d-flex">
                        <h4 class="page-title mb-0">
                            Task Management
                        </h4>

                        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                        </a>
                    </div>

                    <!-- <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
                        <div class="hstack gap-3 mb-3 mb-lg-0">
                            <button type="button" class="btn btn-primary">
                                <i class="ph-gear me-2"></i>
                                Button
                            </button>

                            <div class="dropdown">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                                    Dropdown
                                </button>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <button type="button" class="dropdown-item">Menu item 1</button>
                                    <button type="button" class="dropdown-item">Menu item 2</button>
                                    <button type="button" class="dropdown-item">Menu item 3</button>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item">Menu item 4</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="page-header-content d-lg-flex border-top">
                    <div class="d-flex">
                        <div class="breadcrumb py-2">
                            <a href="" class="breadcrumb-item"><i class="ph-house"></i><span class="ms-1">Home</span></a>
                            <span class="breadcrumb-item active">Manage Tasks</span>
                        </div>

                        <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <div class="row d-flex align-items-baseline">
                            <div class="col-6"><h5>Task List</h5></div>
                            <div class="col-6 d-flex justify-content-end">
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add New Task</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Task</th>
										<th>Short Description</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody id="task-container">
									
								</tbody>
							</table>
						</div>
                    </div>
                </div>
            </div>
            <!-- /content area -->
        </div>
        <!-- /inner content -->

        <!-- Add Task Modal -->
        <div class="modal" tabindex="-1" id="addTaskModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addForm">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="taskTitle" class="col-form-label">Task Title</label>
                                <input type="text" id="taskTitle" name="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="decription" class="col-form-label">Description</label>
                                <textarea id="decription" name="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="col-form-label">Priority</label>
                                <select id="priority" name="priority" class="form-control">
                                    <option value="">--Select An Priority--</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeTaskBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="addTaskBtn" class="btn btn-primary" onclick="addTask()">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Task Modal -->

        <!-- Update Status Modal -->
        <div class="modal" tabindex="-1" id="updateModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Task Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateTask">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status" class="col-form-label">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="">--Select An Status--</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Completed</option>
                                </select>
                            </div>
                            <input type="hidden" id="updateItemId" name="updateItemId" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateTaskClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="updateTaskBtn" class="btn btn-primary" onclick="updateStatus()">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Update Status Modal -->

        <!-- Priority Modal -->
        <div class="modal" tabindex="-1" id="priorityModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Prioirty of Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="changePriority">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="priority" class="col-form-label">Priority</label>
                                <select id="priority" name="priority" class="form-control">
                                    <option value="">--Select An Priority--</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                            <input type="hidden" id="changePriorityItemId" name="changePriorityItemId" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="changePriorityClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="changePriorityBtn" class="btn btn-primary" onclick="changePriority()">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Priority Modal -->

        <script>
            $(document).ready(function() {
                taskList();
            });

            function taskList(){
                $.ajax({
                    url: '/task-list',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var taskList = $('#task-container');
                        taskList.empty();
                        $.each(response, function(index, task) {
                            var status = "";
                            if(task.completed == 0){
                                status = 'PENDING';
                            }else{
                                status = 'COMPLETED';
                            }
                            var taskHtml = `<tr id="task-${task.id}">`;
                            taskHtml += '<td>' + task.id + '</td>';
                            taskHtml += '<td>' + task.title + '</td>';
                            taskHtml += '<td>' + task.description + '</td>';
                            taskHtml += '<td>' + task.priority + '</td>';
                            taskHtml += '<td>' + status + '</td>';
                            taskHtml += '<td>' + 
                                            `<div class="d-flex flex-column">
                                                <button id="${task.id}" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="${task.id}">Update</button>
                                                <button id="${task.id}" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#priorityModal" data-id="${task.id}">Change Priority</button>
                                                <button id="${task.id}" onclick="deleteTask(${task.id})" class="btn btn-danger">Delete</button>
                                            </div>` + 
                                        '</td>';
                            taskHtml += '</tr>';
                            taskList.append(taskHtml);
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function addTask(){
                var formData = $('#addForm').serialize();
                $.ajax({
                    url: '/add-task',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        taskList();
                        $('#closeTaskBtn').trigger('click');
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $('#updateModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                $('#updateItemId').val(itemId);
            });

            $('#priorityModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                $('#changePriorityItemId').val(itemId);
            });

            function updateStatus(){
                var formData = $('#updateTask').serialize();
                $.ajax({
                    url: '/update-task',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        taskList();
                        $('#updateTaskClose').trigger('click');
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function changePriority(id){
                var formData = $('#changePriority').serialize();
                $.ajax({
                    url: '/change-task-priority',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        taskList();
                        $('#changePriorityClose').trigger('click');
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function deleteTask(taskId){
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/delete-task',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    data: {
                        taskId: taskId,
                    },                    
                    dataType: 'json',
                    success: function(response) {
                        $('#task-'+taskId).remove();
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
    @endsection