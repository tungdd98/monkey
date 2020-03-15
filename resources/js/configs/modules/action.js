const action = {
  default: [
    { title: 'Edit', type: 'primary', icon: 'el-icon-edit', size: 'small' },
    { title: 'Delete', type: 'danger', icon: 'el-icon-delete', size: 'small' }
  ],
  slider: [
    { title: 'Edit', type: 'primary', icon: 'el-icon-edit', size: 'small', event: 'handleShow' },
    { title: 'Delete', type: 'danger', icon: 'el-icon-delete', size: 'small', event: 'handleDelete' }
  ]
}
export default action