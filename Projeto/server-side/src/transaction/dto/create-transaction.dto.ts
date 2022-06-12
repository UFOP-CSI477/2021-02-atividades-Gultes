import { ApiProperty } from '@nestjs/swagger';

export class CreateTransactionDto {
  @ApiProperty()
  title: string;
  @ApiProperty()
  description: string;
  @ApiProperty()
  value: string;
  @ApiProperty()
  category: string;
  @ApiProperty()
  userId: number;
}
