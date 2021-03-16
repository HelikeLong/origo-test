import {Plan} from "./Plan";

export interface Client {
  id: number;
  name: string;
  email: string;
  phone: string;
  state: string;
  city: string;
  birthday: string;
  created_at?: string;
  updated_at?: string;
  deleted_at?: string;
  plans?: Plan[];
}
