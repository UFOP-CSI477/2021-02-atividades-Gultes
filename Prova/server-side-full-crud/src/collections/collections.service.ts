import { Injectable } from '@nestjs/common';
import { PrismaService } from '../prisma/prisma.service';
import { CreateCollectionDto } from './dto/create-collection.dto';
import { UpdateCollectionDto } from './dto/update-collection.dto';

@Injectable()
export class CollectionsService {
  constructor(private prisma: PrismaService) {}

  create(createCollectionDto: CreateCollectionDto) {
    return this.prisma.collections.create({ data: createCollectionDto });
  }

  async findAll() {
    const collections = await this.prisma.collections.findMany({
      select: {
        id: true,
        created_at: true,
        quantity: true,
        updated_at: true,
        item: {
          select: {
            id: true,
            description: true,
          },
        },
        entity: {
          select: {
            id: true,
            city: true,
            name: true,
            state: true,
            district: true,
          },
        },
      },
    });

    return collections;
  }

  async findOne(id: string) {
    const collection = await this.prisma.collections.findUnique({
      where: { id },
      rejectOnNotFound: true,
    });

    return collection;
  }

  update(id: string, updateCollectionDto: UpdateCollectionDto) {
    return this.prisma.collections.update({
      data: updateCollectionDto,
      where: { id },
    });
  }

  remove(id: string) {
    return this.prisma.collections.delete({ where: { id } });
  }
}
