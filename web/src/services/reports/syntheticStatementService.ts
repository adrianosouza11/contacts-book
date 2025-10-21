import axios from "axios";

interface DetailTransaction {
  id: string
  transactionValue: number
  nsu: string
  brand: string
  paymentId: string
  paymentDate: Date
  transactionType: string
  netValue: number
  sellerName: string
  netScheduleAmount: string
  sellerId: number
}

export interface HttpGetDetailTransactionRequest {
  status: number
  message: string
  data: Array<DetailTransaction>
}

export async function fetchDetailTransaction(paymentId: string) {
  return axios.get<HttpGetDetailTransactionRequest>('http://localhost:8000/api/reports/synthetic-statements/' + paymentId,{
    headers: {
      Accept: 'application/json'
    }
  });
}