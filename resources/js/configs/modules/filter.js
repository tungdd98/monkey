const filter = {
  per_page: [
    {
      title: '2',
      value: 2
    },
    {
      title: '5',
      value: 5
    },
    {
      title: '10',
      value: 10
    },
    {
      title: '20',
      value: 20
    },
    {
      title: '50',
      value: 50
    },
    {
      title: '100',
      value: 100
    },
    {
      title: 'Tất cả',
      value: 0
    }
  ],
  order: [
    {
      id: 0,
      title: 'A-Z',
      value: {
        order_by: 'title',
        order_dir: 'asc'
      }
    },
    {
      id: 1,
      title: 'Z-A',
      value: {
        order_by: 'title',
        order_dir: 'desc'
      }
    },
    {
      id: 2,
      title: 'Ngày tạo gần đây',
      value: {
        order_by: 'created_at',
        order_dir: 'desc'
      }
    }
  ]
}
export default filter