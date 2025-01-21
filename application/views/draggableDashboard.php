<?php
    $this->load->view('./templates/header.php');
?>
<div class="page-header-breadcrumb">
    <ul class="breadcrumb-title">
        <li class="breadcrumb-item">
            <a><i class="ti-home"></i> Dashboard</a>
        </li>
    </ul>
</div>
<div class="container">
    <div class="column">
        <h1>All opcos</h1>
            <div class="item" draggable="true">
                <div class="card-block">
                     <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="text-c-purple">Mounika</h4>
                                 <h6 class="text-muted m-b-0">Snow</h6>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fa fa-bar-chart f-28"></i>
                            </div>
                        </div>
                    </div>
                        <div class="card-footer bg-c-purple">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <p class="text-white m-b-0"></p>
                                    <h4>Deatails</h4>
                                </div>
                                <div class="col-3 text-right">
                                    <i class="fa fa-line-chart text-white f-16"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                        <div class="item" draggable="true">uganda</div>
                        <div class="item" draggable="true">benin</div>
                        <div class="item" draggable="true">nigeria</div>
                        <div class="item" draggable="true">gc</div>
                        <div class="item" draggable="true">congo</div>
                        <div class="item" draggable="true">iran</div> 
                        
                     </div>
                    <div class="column">
                        <h1>digital</h1>
                    </div>
                    <div class="column">
                        <h1>legacy</h1>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .container{
    font-family: "Trebuchet MS", sans-serif;
    display: flex;
    gap: 30px;
}
.column{
    flex-basis: 100%;
    background: #ddd;
    min-height: 90vh;
    padding: 20px;
    border-radius: 10px;
}
.column h1{
    text-align: center;
    font-size: 22px;
}
.item{
    background: #fff;
    margin: 20px;
    padding: 20px;
    border-radius: 3px;
    cursor: pointer;
}
.invisible{
    display: none;
}

.column1 {
  float: right; 
  /* width: 50%; */
}
.column2 {
  float: left;
  /* width: 50%; */
} 

</style>
<script type="text/javascript">

const items = document.querySelectorAll('.item')
const columns = document.querySelectorAll('.column')

items.forEach(item => {
    item.addEventListener('dragstart', dragStart)
    item.addEventListener('dragend', dragEnd)
});

function dragStart() {
    console.log('drag started');
    setTimeout(() => this.className = 'invisible', 0)
}
function dragEnd() {
    console.log('drag ended');
}

columns.forEach(column => {
    column.addEventListener('dragover', dragOver);
    column.addEventListener('dragenter', dragEnter);
    column.addEventListener('dragleave', dragLeave);
    column.addEventListener('drop', dragDrop);
});

function dragOver() {
    console.log('drag over');
}
function dragEnter() {
    console.log('drag entered');
}
function dragLeave() {
    console.log('drag left');
}
function dragDrop() {
    console.log('drag dropped');
}

function dragOver(e) {
  e.preventDefault()
  console.log('drag over');
}

let dragItem = null;

function dragStart() {
    console.log('drag started');
    dragItem = this;
    setTimeout(() => this.className = 'invisible', 0)
}

function dragEnd() {
    console.log('drag ended');
    this.className = 'item'
    dragItem = null;
}

function dragDrop() {
    console.log('drag dropped');
    this.append(dragItem);
}

</script>

<?php
    $this->load->view('./templates/footer.php');
    $this->load->view('./metaDataScript.php');
?>
