// eslint-disable-next-line @typescript-eslint/no-unused-vars
declare namespace App {
    type User = Partial<{
        id: number
        name: string
        email: string
        email_verified_at: string
        password: string
        remember_token: string
    }>

    type Invoice = Partial<{
        id: number
        user_id: User['id']
        vendor_name: string
        amount: number
        due_date: string
        description: string
        paid: boolean
        created_at: string
        updated_at: string
        user: User
    }>

    type LaravelPaginator<TModel> = {
        current_page: number
        data: TModel[]
        first_page_url: string
        from: number
        last_page: number
        last_page_url: string
        links: any[]
        next_page_url: string
        path: string
        per_page: number
        to: number
        total: number
    }
}
